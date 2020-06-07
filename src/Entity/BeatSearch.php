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
    public function getBeatBpmMin(): ?int
    {
        return $this->beatBpmMin;
    }

    /**
     * @param int|null $beatBpmMin
     * @return BeatSearch
     */
    public function setBeatBpmMin(int $beatBpmMin): BeatSearch
    {
        $this->beatBpmMin = $beatBpmMin;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBeatBpmMax(): ?int
    {
        return $this->beatBpmMax;
    }

    /**
     * @param int|null $beatBpmMax
     * @return BeatSearch
     */
    public function setBeatBpmMax(int $beatBpmMax): BeatSearch
    {
        $this->beatBpmmax = $beatBpmMax;
        return $this;
    }


}