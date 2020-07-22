<?php
declare(strict_types=1);

namespace UnknownOre\MobStacker;

use pocketmine\entity\Living;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use slapper\entities\SlapperEntity;
use slapper\entities\SlapperHuman;

//Minion Fix
use CLADevs\Minion\minion\Minion;

class EventHandler implements Listener{
    
    /**
     * @param EntityDamageEvent $event
     */
    public function onDamage(EntityDamageEvent $event): void{
        $entity = $event->getEntity();
        if($entity instanceof SlapperEntity or $entity instanceof SlapperHuman) return;
        if(!$entity instanceof Living or $entity instanceof Player) return;
        $mobstacker = new Mobstacker($entity);
        if($mobstacker->removeStack()) $event->setCancelled(true);
    }
    
    /**
     * @param EntitySpawnEvent $event
     */
    public function onSpawn(EntitySpawnEvent $event): void{
        $entity = $event->getEntity();
        if($entity instanceof SlapperEntity or $entity instanceof SlapperHuman) return;
        if($entity instanceof Player or !$entity instanceof Living) return;
        if($entity instanceof Minion) return;
        $mobstacker = new Mobstacker($entity);
        $mobstacker->Stack();
    }
}
