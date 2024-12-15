<?php

class ExistDBConnection
{
    private $baseUrl;
    private $username;
    private $password;

    /**
     * Constructeur de la classe
     * 
     * @param string $baseUrl  L'URL de base du serveur eXist-db (par exemple, http://localhost:8080/exist/rest)
     * @param string $username Nom d'utilisateur pour l'authentification
     * @param string $password Mot de passe pour l'authentification
     */
    public function __construct($baseUrl, $username, $password)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Exécute une requête XQuery sur le serveur eXist-db
     * 
     * @param string $xquery La requête XQuery à exécuter
     * @return mixed Résultat de la requête ou erreur
     */
    public function executeQuery($xquery)
    {
        $url = $this->baseUrl . '/_query';
        
        $headers = [
            'Content-Type: application/xml',
        ];

        $data = "<query xmlns='http://exist.sourceforge.net/NS/exist' start='1' max='10'>
                    <text>" . htmlspecialchars($xquery, ENT_XML1, 'UTF-8') . "</text>
                 </query>";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return "Erreur cURL : " . curl_error($ch);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            return $response; // Succès
        } else {
            return "Erreur HTTP $httpCode : " . $response;
        }
    }

    /**
     * Récupère un fichier XML ou une ressource depuis eXist-db
     * 
     * @param string $resourcePath Le chemin du fichier ou de la ressource dans eXist-db
     * @return mixed Contenu du fichier ou erreur
     */
    public function getResource($resourcePath)
    {
        $url = $this->baseUrl . '/' . ltrim($resourcePath, '/');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return "Erreur cURL : " . curl_error($ch);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            return $response; // Succès
        } else {
            return "Erreur HTTP $httpCode : " . $response;
        }
    }
}

