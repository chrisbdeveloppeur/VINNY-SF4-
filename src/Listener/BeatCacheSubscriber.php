<?php


namespace App\Listener;


use App\Entity\Beat;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class BeatCacheSubscriber implements  EventSubscriber
{

    /**
     * @var CacheManager
     */
    private  $cacheManager;

    /**
     * @var UploaderHelper
     */
    private  $uploaderHelper;

    /**
     * BeatCacheSubscriber constructor.
     * @param CacheManager $cacheManager
     * @param UploaderHelper $uploaderHelper
     */

    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }

    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'preUpdate'
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if(!$entity instanceof Beat){
            return;
        }
        $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'beatFile'));
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if(!$entity instanceof Beat){
            return;
        }
        if($entity->getBeatFile() instanceof UploadedFile)
        {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'beatFile'));
        }
    }
}