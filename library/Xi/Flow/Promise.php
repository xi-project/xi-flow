<?php
namespace Xi\Flow;

/**
 * Implements a simple future with no error states or other finesse.
 * 
 * Can only be resolved once.
 * A listener will not be called more than once.
 *
 * TODO: Introduce Deferred to decouple resolvation and promise
 */
class Promise
{
    /**
     * @var boolean
     */
    protected $resolved = false;
    
    /**
     * @var mixed
     */
    protected $result;
    
    /**
     * @var array<callback>
     */
    protected $listeners = array();
    
    /**
     * @return Promise
     */
    public static function make()
    {
        return new static;
    }
    
    /**
     * TODO: Should be detached from the Promise itself.
     * 
     * @param mixed $result 
     * @return Promise
     */
    public function resolve($result)
    {
        if (false === $this->resolved) {
            $this->result = $result;
            $this->resolved = true;
            $this->notifyListeners();
        }
        return $this;
    }
    
    /**
     * TODO: Should return a new Promise for chaining
     * 
     * @param callback($result) $do
     * @return void
     */
    public function then($do)
    {
        $result = $this->addListener($do);
        if (true === $this->resolved) {
            $this->notifyListeners();
        }
        return $result;
    }
    
    /**
     * Notifies all listeners
     */
    private function notifyListeners()
    {
        while ($listener = array_shift($this->listeners)) {
            $listener($this->result);
        }
    }
    
    /**
     * @param callback $listener 
     * @return void
     */
    private function addListener($listener)
    {
        $this->listeners[] = $listener;
    }
}