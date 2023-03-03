<?php


class Agent
{
    private int $id;
    private string $name;
    private string $firstname;
    private string $dateOfBirth;
    private int $code;
    private string $nationality;
    private $speciality;

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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getfirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setfirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of dateOfBirth
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set the value of dateOfBirth
     *
     * @return  self
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of nationality
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set the value of nationality
     *
     * @return  self
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

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
}
