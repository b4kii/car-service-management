<?php

namespace App\Core\Commons;

class Formatter
{
    public static function formatDate($date, $format = "d M Y, H:i:s")
    {
        if (!$date) {
            return null;
        }
        
        $timestamp = strtotime($date);
        
        $formattedDateTime = date("d M Y, H:i:s", $timestamp);
        
        return $formattedDateTime;
    }
    
    public static function mapClientType($type)
    {
        $clientTypes = [
            "Individual" => "Osoba fizyczna",
            "Company" => "Firma"
        ];
        
        return $clientTypes[$type] ?? "";
    }
    
    public static function mapRole($role)
    {
        $roles = [
            "Admin" => "Administrator",
            "Manager" => "Kierownik",
            "Worker" => "Pracownik"
        ];
        
        return $roles[$role] ?? "";
    }
}