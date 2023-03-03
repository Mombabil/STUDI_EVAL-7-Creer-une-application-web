<?php

class Mission
{
    private int $id;
    private string $title;
    private string $description;
    private string $codename;
    private string $country;
    private $agents;
    private $contacts;
    private $cibles;
    private string $type;
    private string $planques;
    private string $speciality;
    private string $start;
    private string $end;

    // lors de l'appel du constructeur, on stock le tableau créer dans hydrate($data) dans un nouvel objet
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // on crée une fonction d'hydratation qui renverra un tableau des saisies utilisateurs que l'on pourra stocker dans un objet puis dans la bdd en appelant le constructeur
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    // MISE EN PLACE DES GETTERS ET SETTERS
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of codename
     */
    public function getCodename()
    {
        return $this->codename;
    }

    /**
     * Set the value of codename
     *
     * @return  self
     */
    public function setCodename($codename)
    {
        $this->codename = $codename;

        return $this;
    }

    /**
     * Get the value of country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of agents
     */
    public function getAgents()
    {
        return $this->agents;
    }

    /**
     * Set the value of agents
     *
     * @return  self
     */
    public function setAgents($agents)
    {
        $this->agents = $agents;

        return $this;
    }

    /**
     * Get the value of contacts
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Set the value of contacts
     *
     * @return  self
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * Get the value of cibles
     */
    public function getCibles()
    {
        return $this->cibles;
    }

    /**
     * Set the value of cibles
     *
     * @return  self
     */
    public function setCibles($cibles)
    {
        $this->cibles = $cibles;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of planques
     */
    public function getPlanques()
    {
        return $this->planques;
    }

    /**
     * Set the value of planques
     *
     * @return  self
     */
    public function setPlanques($planques)
    {
        $this->planques = $planques;

        return $this;
    }

    /**
     * Get the value of speciality
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * Set the value of speciality
     *
     * @return  self
     */
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Get the value of start
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set the value of start
     *
     * @return  self
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get the value of end
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set the value of end
     *
     * @return  self
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }
}
