<?php
namespace Plexo\Sdk\Certificate;

class Certificate {
    
    /**
     *
     * @var string SHA1 fingerprint in hex.
     */
    public $fingerprint;
    
    /**
     *
     * @var string Public key Base64 encoded and contain "-----BEGIN CERTIFICATE-----" and "-----END CERTIFICATE-----" statements.
     */
    public $cert;

    /**
     *
     * @var string Private key Base64 encoded and contain "-----BEGIN PRIVATE KEY-----" and "-----END PRIVATE KEY-----" statements.
     */
    public $pkey;
    
    /**
     *
     * @param string $cert
     * @param string $pkey
     * @param string $fingerprint
     */
    public function __construct($cert = null, $pkey = null, $fingerprint = null)
    {
        if (!is_null($cert)) {
            $this->cert = $cert;
        }
        if (!is_null($pkey)) {
            $this->pkey = $pkey;
        }
        if (!is_null($fingerprint) && is_string($fingerprint)) {
            $this->fingerprint = strtoupper($fingerprint);
        }
    }

    public static function fromServerPublicKey($key, $fingerprint = null)
    {
        $cert = new self(null, null, $fingerprint);
        $cert->setBase64Cert($key);
        return $cert;
    }
    
    public static function fromPfxFile($filename, $passphrase)
    {
        if (!file_exists($filename)) {
            throw new \Plexo\Sdk\Exception\CertificateException(sprintf('No existe el archivo \'%s\'.', $filename));
        }
        if (!is_readable($filename)) {
            throw new \Plexo\Sdk\Exception\CertificateException(sprintf('El archivo %s no puede ser abierto para lectura.', $filename));
        }
        if (!openssl_pkcs12_read(file_get_contents($filename), $certs, $passphrase)) {
            throw new \Plexo\Sdk\Exception\CertificateException(sprintf('No fue posible leer el certificado del archivo \'%s\'.', $filename));
        }
        $x509 = openssl_x509_read($certs['cert']);
        $fingerprint = openssl_x509_fingerprint($x509, 'sha1');
        return new self($certs['cert'], $certs['pkey'], $fingerprint);
    }

    /**
     * 
     * @param string $key
     * @return \Plexo\Sdk\Certificate\Certificate
     */
    public function setBase64Cert($key)
    {
        $this->cert = sprintf("-----BEGIN CERTIFICATE-----\n%s\n-----END CERTIFICATE-----\n", trim(chunk_split($key, 64, "\n")));
        return $this;
    }

    /**
     * 
     * @param string $key
     * @return \Plexo\Sdk\Certificate\Certificate
     */
    public function setBase64Pkey($key)
    {
        $this->pkey = sprintf("-----BEGIN PRIVATE KEY-----\n%s\n-----END PRIVATE KEY-----\n", trim(chunk_split($key, 64, "\n")));
        return $this;
    }
}
