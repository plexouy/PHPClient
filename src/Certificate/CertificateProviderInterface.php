<?php
namespace Plexo\Sdk\Certificate;

interface CertificateProviderInterface {
    
    /**
     * 
     * @param string $fingerprint
     * @return Certificate
     */
    public function getByFingerprint($fingerprint);
    
    /**
     * 
     * @param \Plexo\Sdk\Certificate\Certificate $certificate
     */
    public function save(Certificate $certificate);
}
