<?php
namespace App\Entity;


class BeatSearch {


    /**
     * @var int|null
     */
    private $beatBpmMin;

    /**
     * @var int|null
     */
    private $beatBpmMax;


    /**
     * @return int|null
     */
    public function getBeatBpmMin()
    {
        return $this->beatBpmMin;
    }

    /**
     * @param int|null $beatBpmMin
     * @return BeatSearch
     */
    public function setBeatBpmMin($beatBpmMin): BeatSearch
    {
        $this->beatBpmMin = $beatBpmMin;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBeatBpmMax()
    {
        return $this->beatBpmMax;
    }

    /**
     * @param int|null $beatBpmMax
     * @return BeatSearch
     */
    public function setBeatBpmMax($beatBpmMax): BeatSearch
    {
        $this->beatBpmmax = $beatBpmMax;
        return $this;
    }


}