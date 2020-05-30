# Proveedor de certificados

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

/**
 * Ejemplo de implementación utilizando la capa de abstracción de acceso a datos PDO.
 */
class MyStore implements Sdk\Certificate\CertificateProviderInterface
{
    private $db;
     
    public function __construct()
    {
        $this->db = new PDO('mysql:dbname=schema;host=localhost', 'user', 'pass');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getByFingerprint($fingerprint)
    {
        $stmt = $this->db->prepare("SELECT HEX(fingerprint) AS fingerprint, pubkey AS cert, privkey AS pkey FROM certificates WHERE fingerprint = UNHEX(?)");
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\\Plexo\\Sdk\\Certificate\\Certificate');
        $stmt->bindParam(1, $fingerprint, PDO::PARAM_STR);
        $stmt->execute();
        $cert = $stmt->fetch();
        $stmt->closeCursor();
        return $cert;
    }

    public function save(Sdk\Certificate\Certificate $certificate)
    {
        $stmt = $this->db->prepare("INSERT INTO certificates (fingerprint, pubkey, privkey) VALUES (:fingerprint, :pubkey, :privkey)");
        $stmt->execute(array(
            ':fingerprint' => hex2bin($certificate->fingerprint),
            ':pubkey' => $certificate->cert,
            ':privkey' => $certificate->pkey
        ));
        $stmt->closeCursor();
    }
}

$store = new MyStore();

// Registrar la clase
Sdk\Registry::add($store, 'CertificateProvider');
```
