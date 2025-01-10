<?php

namespace chx\Composer\Plugin;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\CommandEvent;
use Composer\Plugin\PluginEvents;

class NoUpdate implements EventSubscriberInterface, PluginInterface
{

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            PluginEvents::COMMAND => 'onCommand',
        ];
    }

    public function onCommand(CommandEvent $event)
    {
        if ($event->getCommandName() === 'update' && !$event->getInput()->getOption('lock'))
        {
           throw new \InvalidArgumentException('composer update is disabled. Try composer require instead.');
        }
    }

    public function activate(Composer $composer, IOInterface $io)
    {
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }

}
