<?php

namespace App\Handler;

use App\Message\EmailOutputMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class EmailOutputMessageHandler
{
    public function __invoke(EmailOutputMessage $emailOutputMessage)
    {
        dump($emailOutputMessage);
        dump(new \DateTime());
        return true;
    }

    public static function getHandledMessages(): iterable
    {
        yield EmailOutputMessage::class => [
            'from_transport' => 'default',
        ];
    }
}