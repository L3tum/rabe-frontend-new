<?php


namespace RaBe\Models;

/**
 * Class Error
 */
class Error
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $titel;

    /**
     * @var string
     */
    public $beschreibung;

    /**
     * @var int
     */
    public $status;

    /**
     * @var int
     */
    public $kategorieId;

    /**
     * @var int
     */
    public $arbeitsplatzId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Error
     */
    public function setId(int $id): Error
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitel(): string
    {
        return $this->titel;
    }

    /**
     * @param string $titel
     * @return Error
     */
    public function setTitel(string $titel): Error
    {
        $this->titel = $titel;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeschreibung(): string
    {
        return $this->beschreibung;
    }

    /**
     * @param string $beschreibung
     * @return Error
     */
    public function setBeschreibung(string $beschreibung): Error
    {
        $this->beschreibung = $beschreibung;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Error
     */
    public function setStatus(int $status): Error
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getKategorieId(): int
    {
        return $this->kategorieId;
    }

    /**
     * @param int $kategorieId
     * @return Error
     */
    public function setKategorieId(int $kategorieId): Error
    {
        $this->kategorieId = $kategorieId;
        return $this;
    }

    /**
     * @return int
     */
    public function getArbeitsplatzId(): int
    {
        return $this->arbeitsplatzId;
    }

    /**
     * @param int $arbeitsplatzId
     * @return Error
     */
    public function setArbeitsplatzId(int $arbeitsplatzId): Error
    {
        $this->arbeitsplatzId = $arbeitsplatzId;
        return $this;
    }
}
