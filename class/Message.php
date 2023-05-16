<?php
class Message {

    public $pseudo;
    public $message;
    private $date;
    public $errors = [];

    public function __construct(string $pseudo, string $message, DateTime $date = null)
    {
        $this->pseudo = $pseudo;
        $this->message = $message;
        if($date == null) {
            $this->date = new DateTime();
        } else {
            $this->date = $date;
        }
    }

    public static function fromJSON($messageJson): Message
    {
        $messageobject = json_decode($messageJson);
        $date = date('Y/m/d H:m', $messageobject->date);
        $message = new Message($messageobject->pseudo, $messageobject->message, new DateTime($date));
        return $message;
    }

    public function toHTML(): string
    {   
        $date = $this->date->format('d/m/Y');
        $heure = $this->date->format('H:m');
        return <<<HTML
        <p>
            <strong>$this->pseudo</strong> <em>le $date à $heure</em><br>
            $this->message
        </p>
HTML;
    }

    public function toJSON(): string
    {
        return json_encode([
            'pseudo' => $this->pseudo, 
            'message' => $this->message, 
            'date' => (int)($this->date->format('U'))
        ]);
    }

    public function isValid(): bool
    {
        if(strlen($this->pseudo) < 3 || strlen($this->message) < 10) {
            return false;
        }
        return true;
    }

    public function getErrors(): array{
        return $this->errors;
    }
}