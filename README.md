# grafikart_PHP-HTML

Codes de la formation de Grafikart https://grafikart.fr/formations/php
IMPORTANT : non vérifié en PHP 8.0


# Chapitre 27, TP Livre d'or

- On aura un page avec un formulaire
    - Un champs pour le nom de l'utilisateur
    - Un champs message
    - Un bouton
    (le formulaire devra être validé et on n'acceptera pas les pseudo  de moins de 3 caractères ni les messages de moins de 10 caractères)
- On créera un fichier "messages" qui contiendra un message par ligne
(on utilisera serialize et un tableau ['username' => '....', 'message' => '....', 'date' => ])
    - Pour serailiser les messages on utilisera la fonction json_encode(tableau) et json_decode(tableau, true)
- La page devra afficher tous les messages sous le formulaires formaté de la manière suivante:
<p>
    <strong>Pseudo</strong> <em>le 03/12/2009 à 12h00</em>
</p>
(les sauts de lignes devront être conservés nl2br)

## Restrictions

- Utiliser une class pour représenter un message
    - new Message(string $username, string $message, DateTime $date = null)
    - isValid(): bool
    - getErrors(): array   //  indexé par le nom du champs avec erreur
    - toHTML(): string
    - toJSON(): string
    - Message::fromJSON(string $messageJson): Message
- Utiliser une classe pour représenter le livre d'or
    - new GuestBook($fichier)
    - addMessage(Message $message)
    - getMessages(): array