<?php
require_once 'Message.php';

class GuestBook {

    private $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function getMessages(): array
    {
        $messages = (file($this->file, FILE_SKIP_EMPTY_LINES));
        foreach($messages as $key => $message) {
            $messages[$key] = Message::fromJSON($message);
        }
        return $messages;
    }

    public function addMessage(Message $message)
    {
        $message = "\n" . $message->toJSON();
        file_put_contents($this->file, $message, FILE_APPEND);
    }
}