<?php
class tache
{
    public $titre;
    public $desc;

    function __construct(string $titre, string $desc)
    {
        $this->titre = $titre;
        $this->desc = $desc;
    }

    function sayTache()
    {
        echo "Le titre est " . $this->titre . " et tu dois faire " . $this->desc;
    }
}
