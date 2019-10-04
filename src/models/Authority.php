<?php

namespace RaBe\Models;

/**
 * Class Authority
 */
class Authority
{
    /**
     * @var int
     */
    public $id;

    /** @var int */
    public $lehrerId;
    /**
     * @var int
     */
    public $raumId;

    /**
     * @var bool
     */
    public $betreuer;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Authority
     */
    public function setId(int $id): Authority
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getLehrerId(): int
    {
        return $this->lehrerId;
    }

    /**
     * @param int $lehrerId
     * @return Authority
     */
    public function setLehrerId(int $lehrerId): Authority
    {
        $this->lehrerId = $lehrerId;
        return $this;
    }

    /**
     * @return int
     */
    public function getRaumId(): int
    {
        return $this->raumId;
    }

    /**
     * @param int $raumId
     * @return Authority
     */
    public function setRaumId(int $raumId): Authority
    {
        $this->raumId = $raumId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBetreuer(): bool
    {
        return $this->betreuer;
    }

    /**
     * @param bool $betreuer
     * @return Authority
     */
    public function setBetreuer(bool $betreuer): Authority
    {
        $this->betreuer = $betreuer;
        return $this;
    }
}
