<?php

namespace App;

use App\Exception\ForbidenException;
use App\User;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class Auth {

    private $pdo;
    private $loginPath;
    private $session;

    public function __construct(\PDO $pdo, string $loginPath, array &$session)
    {
        $this->pdo = $pdo;
        $this->loginPath = $loginPath;
        $this->session = &$session;
    }

    public function user(): ?User
    {
        
        $id = $this->session['auth'] ?? null;
        if($id === null){
            return null;
        }
        $query = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $query->execute([$id]);
        $user = $query->fetchObject(User::class);
        return $user ?: null;
    }

    public function requireRole(string ...$roles): void
    {
        $user = $this->user();
        if ($user === null){
            throw new ForbidenException("Vous devez être connecté pour voir cette page");
        }
        if (!in_array($user->role, $roles)) {
            $roles = implode(',', $roles);
            $role = $user->role;
            throw new ForbidenException("Vous n'avez pas le rôle suffisant \"$role\" (attendu : $roles)");
        }
    }

    public function login(string $username, string $password): ?User
    {
        // Trouve l'utilisateur correspondant au username
        $query = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $query->execute(['username' => $username]);
        // $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $user = $query->fetchObject(User::class);
        
        // On vérifie avec password_verifie que le password correspond
        if($user) {
            if(password_verify($password , $user->password)){
                $this->session['auth'] = $user->id;
                return $user;
            }
        }

        return null;
    }

}