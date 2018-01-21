<?php
namespace Emitente\Entity;


use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

/**
 * Emitente
 *
 * @ORM\Table(name="emitentes", uniqueConstraints={@ORM\UniqueConstraint(name="emitentes_cnpj_key", columns={"cnpj"})}, indexes={@ORM\Index(name="IDX_3DDB242B58BC1BE0", columns={"municipio_id"}), @ORM\Index(name="IDX_3DDB242B705D2C5F", columns={"uf_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Emitente\Repository\EmitenteRepository")
 */
class Emitente
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="emitentes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="razao", type="string", length=60, nullable=false)
     */
    private $razao;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fantasia", type="string", length=60, nullable=true)
     */
    private $fantasia;

    /**
     * @var string
     *
     * @ORM\Column(name="cnpj", type="string", length=14, nullable=false, options={"fixed"=true})
     */
    private $cnpj;

    /**
     * @var string
     *
     * @ORM\Column(name="ie", type="string", length=14, nullable=false)
     */
    private $ie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cnae", type="string", length=7, nullable=true, options={"fixed"=true})
     */
    private $cnae;

    /**
     * @var string|null
     *
     * @ORM\Column(name="im", type="string", length=15, nullable=true)
     */
    private $im;

    /**
     * @var string|null
     *
     * @ORM\Column(name="iest", type="string", length=14, nullable=true)
     */
    private $iest;

    /**
     * @var string
     *
     * @ORM\Column(name="logradouro", type="string", length=60, nullable=false)
     */
    private $logradouro;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var string|null
     *
     * @ORM\Column(name="complemento", type="string", length=60, nullable=true)
     */
    private $complemento;

    /**
     * @var string
     *
     * @ORM\Column(name="bairro", type="string", length=60, nullable=false)
     */
    private $bairro;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", nullable=false)
     */
    private $cep;

    /**
     * @var int
     *
     * @ORM\Column(name="pais_id", type="integer", nullable=false)
     */
    private $paisId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telefone", type="string", length=14, nullable=true)
     */
    private $telefone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="date", nullable=false)
     */
    private $dateCreate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_update", type="date", nullable=false)
     */
    private $dateUpdate;

    /**
     * @var \Municipio
     *
     * @ORM\ManyToOne(targetEntity="Tabelas\Entity\Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="municipio_id", referencedColumnName="id")
     * })
     */
    private $municipio;

    /**
     * @var \Estado
     *
     * @ORM\ManyToOne(targetEntity="Tabelas\Entity\Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="uf_id", referencedColumnName="id")
     * })
     */
    private $uf;



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set razao.
     *
     * @param string $razao
     *
     * @return Emitentes
     */
    public function setRazao($razao)
    {
        $this->razao = $razao;

        return $this;
    }

    /**
     * Get razao.
     *
     * @return string
     */
    public function getRazao()
    {
        return $this->razao;
    }

    /**
     * Set fantasia.
     *
     * @param string|null $fantasia
     *
     * @return Emitentes
     */
    public function setFantasia($fantasia = null)
    {
        $this->fantasia = $fantasia;

        return $this;
    }

    /**
     * Get fantasia.
     *
     * @return string|null
     */
    public function getFantasia()
    {
        return $this->fantasia;
    }

    /**
     * Set cnpj.
     *
     * @param string $cnpj
     *
     * @return Emitentes
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get cnpj.
     *
     * @return string
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set ie.
     *
     * @param string $ie
     *
     * @return Emitentes
     */
    public function setIe($ie)
    {
        $this->ie = $ie;

        return $this;
    }

    /**
     * Get ie.
     *
     * @return string
     */
    public function getIe()
    {
        return $this->ie;
    }

    /**
     * Set cnae.
     *
     * @param string|null $cnae
     *
     * @return Emitentes
     */
    public function setCnae($cnae = null)
    {
        $this->cnae = $cnae;

        return $this;
    }

    /**
     * Get cnae.
     *
     * @return string|null
     */
    public function getCnae()
    {
        return $this->cnae;
    }

    /**
     * Set im.
     *
     * @param string|null $im
     *
     * @return Emitentes
     */
    public function setIm($im = null)
    {
        $this->im = $im;

        return $this;
    }

    /**
     * Get im.
     *
     * @return string|null
     */
    public function getIm()
    {
        return $this->im;
    }

    /**
     * Set iest.
     *
     * @param string|null $iest
     *
     * @return Emitentes
     */
    public function setIest($iest = null)
    {
        $this->iest = $iest;

        return $this;
    }

    /**
     * Get iest.
     *
     * @return string|null
     */
    public function getIest()
    {
        return $this->iest;
    }

    /**
     * Set logradouro.
     *
     * @param string $logradouro
     *
     * @return Emitentes
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * Get logradouro.
     *
     * @return string
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * Set numero.
     *
     * @param int $numero
     *
     * @return Emitentes
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero.
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set complemento.
     *
     * @param string|null $complemento
     *
     * @return Emitentes
     */
    public function setComplemento($complemento = null)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get complemento.
     *
     * @return string|null
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set bairro.
     *
     * @param string $bairro
     *
     * @return Emitentes
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro.
     *
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set cep.
     *
     * @param string $cep
     *
     * @return Emitentes
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep.
     *
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set paisId.
     *
     * @param int $paisId
     *
     * @return Emitentes
     */
    public function setPaisId($paisId)
    {
        $this->paisId = $paisId;

        return $this;
    }

    /**
     * Get paisId.
     *
     * @return int
     */
    public function getPaisId()
    {
        return $this->paisId;
    }

    /**
     * Set telefone.
     *
     * @param string|null $telefone
     *
     * @return Emitentes
     */
    public function setTelefone($telefone = null)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone.
     *
     * @return string|null
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set dateCreate.
     *
     * @param \DateTime $dateCreate
     *
     * @return Emitentes
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate.
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set dateUpdate.
     *
     * @param \DateTime $dateUpdate
     *
     * @return Emitentes
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * Get dateUpdate.
     *
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * Set municipio.
     *
     * @param \Municipios|null $municipio
     *
     * @return Emitentes
     */
    public function setMunicipio(\Municipio $municipio = null)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get municipio.
     *
     * @return \Municipios|null
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set uf.
     *
     * @param \Estados|null $uf
     *
     * @return Emitentes
     */
    public function setUf(\Estado $uf = null)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get uf.
     *
     * @return \Estados|null
     */
    public function getUf()
    {
        return $this->uf;
    }
    
    /**
     * Gets triggered only on insert
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->dateCreate = date('Y-m-d');
        $this->dateUpdate = date('Y-m-d');
    }
    
    /**
     * Gets triggered every time on update
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->dateUpdate = date('Y-m-d');
    }
    
    public function exchangeArray($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = (!empty($value) ? $value: null);
        }
    }
    
    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            
            
            $inputFilter->add([
                'name'     => 'razao',
                'required' => true,
                'filters'  => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 50,
                            'messages' => [
                                'stringLengthTooShort' => 'A razão de conter de 1 a 60 characteres!',
                                'stringLengthTooLong' => 'A razão de conter de 1 a 60 characteres!'
                            ],
                        ],
                    ],
                ],
            ]);
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }
}
