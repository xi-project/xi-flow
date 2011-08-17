<?php
namespace Xi\Flow;

class Maybe
{
    protected $value;
    
    /**
     * @param mixed $value
     */
     public function __construct($value)
     {
         $this->value = $value;
     }
     
     /**
      * @return boolean
      */
      public function isEmpty()
      {
          return empty($this->value);
      }
     
     /**
      * @return mixed
      */
      public function get()
      {
          return $this->value;
      }
      
      /**
       * @param mixed $value
       * @return mixed
       */
       public function getOrElse($value)
       {
           if ($this->isEmpty()) {
               return $value;
           }
           return $this->value;
       }
     
     /**
      * @param mixed $value
      * @return Maybe
      */
      public function orElse($value)
      {
           if ($this->isEmpty()) {
              return new static($value);
          }
          return $this;
      }
      
     /**
      * @return Maybe
      */
      public function orNull()
      {
          return $this->orElse(null);
      }
     
     /**
      * @param callback $callback
      * @param callback $fallback optional
      * @return callback or fallback return value
      */
     public function then($callback, $fallback = null)
     {
         if ($this->isEmpty()) {
             return $callback($this->value);
         }
         if (null !== $fallback) {
             return $fallback($this->value);
         }
     } 
     
     /**
      * @param callback $callback
      * @return Maybe
      */
     public function withValue($callback)
     {
           if (!$this->isEmpty()) {
             $callback($this->value);
         }
         return $this;
     }
     
     /**
      * @param callback $callback
      * @return Maybe
      */
      public function withoutValue($callback)
      {
           if ($this->isEmpty()) {
              $callback($this->value);
          }
          return $this;
      }
}


