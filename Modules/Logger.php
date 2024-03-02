<?php

namespace App\Modules;

use Stringable;
use Monolog\Level;
use Monolog\Logger as Monolog;
use Monolog\Handler\StreamHandler;

class Logger
{
    public static $log;
    public array $log_config;
    public string|Stringable $channel;

    public function __construct(array $log_config)
    {
        $this->log_config = $log_config;
    }

    public function channel(string|Stringable $channel)
    {
        $this->channel = $this->log_config[$channel]['channel'];

        self::$log = new Monolog($this->channel);
    }

    protected function driver()
    {
        $logger = self::$log;

        $logger->pushHandler(
            new StreamHandler(
                $this->log_config[$this->channel]['path'],
                Level::fromName($this->log_config[$this->channel]['level'])
            )
        );

        return $logger;
    }

    /**
     * Il sistema e' inutilizzabile.
     * 
     * @param string|Stringable $message
     * @param mixed[] $context
     * 
     * @return void 
     */
    public function emergency(string|Stringable $message, array $context = []): void
    {
        $this->driver()->warning($message, $context);
    }

    /**
     * Un'azione dev'essere eseguita immediatamente.
     *
     * Esempio: Il sito completamente down, database non disponibile, ecc. Questo dovrebbe
     * inviare un alert SMS e svegliarti.
     *
     * @param  string|\Stringable  $message
     * @param  array  $context
     * 
     * @return void
     */
    public function alert($message, array $context = []): void
    {
        $this->driver()->alert($message, $context);
    }

    /**
     * Errori di runtime che non richiedono azioni immediate, ma che dovrebbero
     * essere loggati e monitorati
     *
     * @param  string|\Stringable  $message
     * @param  array  $context
     * 
     * @return void
     */
    public function error($message, array $context = []): void
    {
        $this->driver()->error($message, $context);
    }

    /**
     * Accadimenti eccezionali che non sono errori.
     *
     * Esempio: uso di API deprecate, utilizzo pessimo di un'API, cose non
     * desiderabili che pero' non sono necessariamente sbagliate
     *
     * @param  string|\Stringable  $message
     * @param  array  $context
     * 
     * @return void
     */
    public function warning($message, array $context = []): void
    {
        $this->driver()->warning($message, $context);
    }

    /**
     * Eventi normali ma significativi.
     *
     * @param  string|\Stringable  $message
     * @param  array  $context
     * 
     * @return void
     */
    public function notice($message, array $context = []): void
    {
        $this->driver()->notice($message, $context);
    }

    /**
     * Eventi interessanti.
     *
     * Esempio: User logs in, SQL logs.
     *
     * @param  string|\Stringable  $message
     * @param  array  $context
     * 
     * @return void
     */
    public function info($message, array $context = []): void
    {
        $this->driver()->info($message, $context);
    }

    /**
     * Informazioni di debug dettagliate.
     *
     * @param  string|\Stringable  $message
     * @param  array  $context
     * 
     * @return void
     */
    public function debug($message, array $context = []): void
    {
        $this->driver()->debug($message, $context);
    }
}
