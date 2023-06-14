<?php

class DB
{
    private static $instance = null;
    private ?PDO $dbh;
    private bool $connected = false;

    /**
     * Constructor privat (Singelton)
     */
    private function __construct()
    {
        try {
            // TODO: usuari i contrasenya?
            $this->dbh = new PDO('mysql:host=localhost;dbname=eleccions', "", "");
            $this->connected = true;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * Mètode per agafar la instància sempre activa (Singelton)
     * @return DB
     */
    public static function get_instance(): DB
    {
        if (self::$instance == null) {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    /**
     * Comprova la connexió amb la base de dades.
     * @return bool
     */
    public function connected() : bool
    {
        return $this->connected;
    }

    /**
     * Retorna un array amb les comarques
     * @return array
     */
    public function get_comarques(): array
    {
        if(!$this->connected) return [];

        $stmt = $this->dbh->prepare("SELECT nom FROM comarques");
        $success = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        if(!$success)
            return [];

        // Converteix a array pla
        $comarques = [];
        foreach ($arr as $row){
            $comarques[] = $row["nom"];
        }

        return $comarques;
    }

    /**
     * Retorna un array amb tots els muncipis on cada element és un array (població, comarca i demarcació)
     * @return array
     */
    public function get_municipis(): array
    {
        if(!$this->connected) return [];

        // TODO: Cal implementar
        $success = false; //...

        if(!$success)
            return [];

        return []; // return $muncipis;
    }

    /**
     * Retorna un array amb les demarcacions
     * @return array
     */
    public function get_demarcacions(): array
    {
        if(!$this->connected) return [];

        // TODO: Cal implementar
        $success = false; //...

        if(!$success)
            return [];

        // TODO: Cal convertir a un array de només els noms de les demarcacions
        return [];  // return $demarcacions;
    }

    /**
     * Retorna un array tots els partits, cada element és un array (nom, color i curt)
     * On curt és el nom abreviat del partit
     * @return array
     */
    public function get_all_partits(): array
    {
        if(!$this->connected) return [];

        $stmt = $this->dbh->prepare("SELECT nom, color, curt FROM partits");
        $success = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        if(!$success)
            return [];

        return $arr;
    }

    /**
     * Retorna tots els partits amb candidatures a una demarcació, cada element és un array (nom, color i curt)
     * On curt és el nom abreviat del partit
     * @param $demarcacio
     * @return array
     */
    public function get_partits($demarcacio): array
    {
        if(!$this->connected) return [];

        // TODO: Cal implementar
        $success = false; //...

        if(!$success)
            return [];

        return []; // return $partits;
    }

    /**
     * Comprova si existeix una demarcació donada
     * @param $demarcacio
     * @return bool
     */
    public function find_demarcacio($demarcacio): bool
    {
        if(!$this->connected) return false;

        // TODO: Cal implementar
        $success = false; //...

        if(!$success)
            return false;

        return false; // return $trobat;
    }

    /**
     * Retorna el nombre d'escons destinats a una demarcació
     * @param string $demarcacio
     * @return int
     */
    public function get_num_escons(string $demarcacio): int
    {
        if(!$this->connected) return 0;

        $stmt = $this->dbh->prepare(
            "SELECT escons FROM demarcacions WHERE UPPER(nom)=UPPER(?);"
        );
        $success = $stmt->execute([$demarcacio]);
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;

        if(!$success || count($arr) < 1)
            return 0;

        return $arr["escons"];
    }

    /**
     * Retorna una llista dels vots de cada partit donada una demarcació
     * Les claus de l'array de sortida són els partits i els valors els vots
     *
     * @param string $demarcacio
     * @return array
     */
    public function get_vots(string $demarcacio) : array
    {
        if(!$this->connected) return [];

        // TODO: Cal implementar
        $success = 0; //...

        if(!$success)
            return [];

        return []; // return $vots;
    }

    /**
     * Retorna una llista dels escons de cada partit donada una demarcació
     * Les claus de l'array de sortida són els partits i els valors els escons
     *
     * @param string $demarcacio
     * @return array
     */
    public function get_escons(string $demarcacio) : array
    {
        if(!$this->connected) return [];

        $stmt = $this->dbh->prepare(
            "SELECT partit, escons FROM escons
            WHERE UPPER(demarcacio) = UPPER(?)"
        );
        $success = $stmt->execute([$demarcacio]);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        if(!$success)
            return [];

        // Converteix al format [partits (clau), escons(valors)]
        $vots = [];
        foreach ($arr as $row){
            $vots[$row["partit"]] = $row["escons"];
        }

        return $vots;
    }

    /**
     * Retorna una llista dels escons aconseguits per cada partit
     * Les claus de l'array de sortida són els partits i els valors els escons
     *
     * @return array
     */
    public function get_all_escons() : array
    {
        if(!$this->connected) return [];

        // TODO: Cal implementar
        $success = 0; //...

        if(!$success)
            return [];

        return []; // return $escons;
    }

    /**
     * Retorna el nombre de demarcacions que ja tenen escons assignats
     *
     * @return int
     */
    public function count_demarcacio_with_escons() : int
    {
        if(!$this->connected) return false;

        //TODO Cal implementar
        $success = 0; //...

        if(!$success)
            return 0;

        return false;
    }

    /**
     * Assigna un array de partits (clau) i escons (valor) a una demarcació
     *
     * @param string $demarcacio
     * @param array $assignacio_escons
     * @return bool
     */
    public function set_escons(string $demarcacio, array $assignacio_escons) : bool
    {
        if(!$this->connected) return false;

        //TODO Cal implementar

        //TODO Recorda que cal esborrar els escons si ja han estat assignats!

        return false;
    }

    /**
     * Assigna un array de partits (clau) i vots (valor) a una població
     *
     * @param string $poblacio
     * @param array $vots_partits
     * @return bool
     */
    public function set_vots(string $poblacio, array $vots_partits) : bool
    {
        if(!$this->connected) return false;

        //TODO Cal implementar

        //TODO Recorda que cal esborrar els vots si ja han estat assignats!

        return false;
    }
}
