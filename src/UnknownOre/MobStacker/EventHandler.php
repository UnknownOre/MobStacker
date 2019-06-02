<?php
declare(strict_types=1);

namespace UnknownOre\MobStacker;


use pocketmine\entity\Living;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\Listener;
use pocketmine\Player;

class EventHandler implements Listener{

    /**
     * @param EntityDamageByEntityEvent $event
     */
    public function onDeath(EntityDamageByEntityEvent $event): void{
        $entity = $event->getEntity();
        if(!$entity instanceof Living or $entity instanceof Player) return;
        $mobstacker = new Mobstacker($entity);
        if(!$mobstacker->isStacked()) return;
        if($mobstacker->removeStack()) $event->setCancelled(true);
    }

    /**
     * @param EntitySpawnEvent $event
     */
    public function onSpawn(EntitySpawnEvent $event): void{
        $entity = $event->getEntity();
        if($entity instanceof Player or !$entity instanceof Living) return;
        $mobstacker = new Mobstacker($entity);
        $mobstacker->Stack();
    }
}
