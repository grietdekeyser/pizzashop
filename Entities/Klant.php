<?php 

//Entities/Klant.php

namespace Entities;

class Klant {
    private static $idMap = array();

    private $id;
    private $email;
    private $wachtwoord;
    private $familienaam;
    private $voornaam;
    private $straat;

    private function __construct(int $id, string $email, string $wachtwoord, string $familienaam, string $voornaam, string $straat, string $huisnummer, string $bus, int $postcode, string $woonplaats, string $telefoon, string $opmerking, string $registratiedatum) {
        $this->id = $id;
        $this->email = $email;
        $this->wachtwoord = $wachtwoord;
        $this->familienaam = $familienaam;
        $this->voornaam = $voornaam;
        $this->straat = $straat;
        $this->huisnummer = $huisnummer;
        $this->bus = $bus;
        $this->postcode = $postcode;
        $this->woonplaats = $woonplaats;
        $this->telefoon = $telefoon;
        $this->opmerking = $opmerking;
        $this->registratiedatum = $registratiedatum;
    }
    
    public static function create(int $id, string $email, string $wachtwoord, string $familienaam, string $voornaam, string $straat , string $huisnummer, string $bus, int $postcode, string $woonplaats, string $telefoon, string $opmerking, string $registratiedatum) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Klant($id, $email, $wachtwoord, $familienaam, $voornaam, $straat, $huisnummer, $bus, $postcode, $woonplaats, $telefoon, $opmerking, $registratiedatum);
        }
        return self::$idMap[$id];
    }

    public function getId() : int {
        return $this->id;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getWachtwoord() : string {
        return $this->wachtwoord;
    }

    public function getFamilienaam() : string {
        return $this->familienaam;
    }

    public function getVoornaam() : string {
        return $this->voornaam;
    }

    public function getStraat() : string {
        return $this->straat;
    }
    
    public function getHuisnummer() : string {
        return $this->huisnummer;
    }

    public function getBus() : string {
        return $this->bus;
    }
    
    public function getPostcode() : int {
        return $this->postcode;
    }

    public function getWoonplaats() : string {
        return $this->woonplaats;
    }
    
    public function getTelefoon() : string {
        return $this->telefoon;
    }

    public function getOpmerking() : string {
        return $this->opmerking;
    }
    
    public function getRegistratiedatum() : string {
        return $this->registratiedatum;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setWachtwoord(string $wachtwoord) {
        $this->wachtwoord = $wachtwoord;
    }

    public function setFamilienaam(string $familienaam) {
        $this->familienaam = $familienaam;
    }

    public function setVoornaam(string $voornaam) {
        $this->voornaam = $voornaam;
    }

    public function setStraat(string $straat) {
        $this->straat = $straat;
    }
    
    public function setHuisnummer(string $huisnummer) {
        $this->huisnummer = $huisnummer;
    }
    
    public function setBus(string $bus) {
        $this->bus = $bus;
    }
    
    public function setPostcode(int $postcode) {
        $this->postcode = $postcode;
    }
    
    public function setWoonplaats(string $woonplaats) {
        $this->woonplaats = $woonplaats;
    }
    
    public function setTelefoon(string $telefoon) {
        $this->telefoon = $telefoon;
    }
    
    public function setOpmerking(string $opmerking) {
        $this->opmerking = $opmerking;
    }

    public function setRegistratieDatum(string $registratiedatum) {
        $this->registratiedatum = $registratiedatum;
    }
}