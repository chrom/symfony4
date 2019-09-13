<?php

declare(strict_types=1);


namespace App\Services;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient
{
    use LoggerTrait;

    /**
     * @var Client
     */
    private $client;

    /**
     * SlackClient constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function sendMessage(string $from, string $message)
    {
        $this->logInfo('Get send message to slack!', [
            'message' => $message
        ]);

        $message = $this->client->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);

        $this->client->sendMessage($message);
    }
}
