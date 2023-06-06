<?php
require_once '../vendor/autoload.php';

$eleves = [
    [
        'nom' => 'Anne',
        'age' => 18,
        'moyenne' => 15
    ],
    [
        'nom' => 'Marc',
        'age' => 21,
        'moyenne' => 13
    ],
    [
        'nom' => 'Jean',
        'age' => 20,
        'moyenne' => 18
    ],
    [
        'nom' => 'Marie',
        'age' => 20,
        'moyenne' => 9
    ]
];


// Passage du callable par variable ($sort)
echo 'Passage du callable par variable ($sort)';
$key = 'age';
$sort = function ($eleve1, $eleve2) use ($key) {
    return $eleve1[$key] - $eleve2[$key];
};
usort($eleves, $sort);
dump($eleves);

// Passage du callable par function sortedByKey1()
echo 'Passage du callable par fonction sortedByKey1()';
function sortedByKey1($key) {
    return function ($eleve1, $eleve2) use ($key) {
        return $eleve1[$key] - $eleve2[$key];
    };
};
usort($eleves, sortedByKey1('moyenne'));
dump($eleves);

// inclusion de usort() dans la function pour retourner un nouveau tableau
echo 'inclusion de usort() dans la fonction pour retourner un nouveau tableau';
function sortedByKey2(array $array, string $key) {
    usort($array, function ($a, $b) use ($key) {
        return $a[$key] - $b[$key];
    });
    return $array;
};
$eleves2 = sortedByKey2($eleves ,'age');
dump($eleves2);

//filtre de tableau par aaray_filter
echo 'array_filter par la moyenne';
$eleveMoyenne = array_filter($eleves, function($eleve){
    return $eleve['moyenne'] > 10;
});
dump($eleveMoyenne);

// utilisation avec un objet
echo 'utilisation dans un objet ';
class Demo {
    
    private $eleves = [
        [
            'nom' => 'Anne',
            'age' => 18,
            'moyenne' => 15
        ],
        [
            'nom' => 'Marc',
            'age' => 21,
            'moyenne' => 13
        ],
        [
            'nom' => 'Jean',
            'age' => 20,
            'moyenne' => 18
        ],
        [
            'nom' => 'Marie',
            'age' => 20,
            'moyenne' => 9
        ]
    ];

    // utilisation fonction anonyme pour le callback
    public function bonEleves1(): array
    {
       return array_filter($this->eleves, function($eleve){
            return $eleve['moyenne'] > 10;
        });
    }

    private function filterFonction($eleve): bool
    {
        return $eleve['moyenne'] > 10;
    }
    // utilisation d'un array ([objet, methode]) pour le callback
    public function bonEleves2(): array
    {
       return array_filter($this->eleves, [$this, 'filterFonction'] );
    }
}

$elevesObj = new Demo();
echo 'utilisation fonction anonyme pour le callback';
dump($elevesObj->bonEleves1());

echo "utilisation d'un array ([objet, methode]) pour le callback";
dump($elevesObj->bonEleves2());