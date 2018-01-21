<?php
namespace Emitente\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
//use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Emitente\Repository\EmitenteRepository")
 * @ORM\Table(name="emitentes")
 */
class Emitente2
{
	protected $inputFilter;
	
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id")
	 * @ORM\Column(type="integer")
	 */
	protected $id;

	/**
	 * @ORM\Column(name="razao")
	 * 
	 */
	protected $razao;	
	
	/**
	 * @ORM\Column(name="fantasia")
	 */
	protected $fantasia;
	
	/**
	 * @ORM\Column(name="cnpj")
	 */
	protected $cnpj;
	
	/**
	 * @ORM\Column(name="ie")
	 */
	protected $ie;
	
	/**
	 * @ORM\Column(name="cnae")
	 */
	protected $cnae;
	
	/**
	 * @ORM\Column(name="im")
	 */
	protected $im;

	/**
	 * @ORM\Column(name="iest")
	 */
	protected $iest;
	
	/**
	 * @ORM\Column(name="logradouro")
	 */
	protected $logradouro;
	
	/**
	 * @ORM\Column(name="numero")
	 */
	protected $numero;
	
	/**
	 * @ORM\Column(name="complemento")
	 */
	protected $complemento;
	
	/**
	 * @ORM\Column(name="bairro")
	 */
	protected $bairro;
	
	/**
	 * @ORM\Column(name="cep")
	 */
	protected $cep;	
	
	/**
	 * @ORM\Column(name="pais_id")
	 */
	protected $pais_id;
	
	/**
    * @var \Emitente\Entity\Emitente
	*
	* @ORM\ManyToOne(targetEntity="\Tabelas\Entity\Estado", inversedBy="emitentes")
	* @ORM\JoinColumns({
	*   @ORM\JoinColumn(name="uf_id", referencedColumnName="id")
	* })
	*/
	protected $uf_id;
	
	/**
    * @var \Emitente\Entity\Emitente
	*
	* @ORM\ManyToOne(targetEntity="\Tabelas\Entity\Municipio", inversedBy="emitentes")
	* @ORM\JoinColumns({
	*   @ORM\JoinColumn(name="municipio_id", referencedColumnName="id")
	* })
	*/
	protected $municipio_id;
	
	/**
	 * @ORM\Column(name="telefone")
	 */
	protected $telefone;
	
	/**
	 * @var datetime
	 * @ORM\Column(name="date_create")
	 */
	protected $dataCadastro;
	
	/**
	 * @var datetime
	 * @ORM\Column(name="date_update")
	 */	
	protected $dataAltera;
	
	
	
	/**
	 * Returns ID of this secao
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Sets ID of this chamados.
	 * @param integer $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getRazao()
	{
		return $this->razao;
	}
	
    /**
	 * Sets titulo.
	 * @param string $razao
	 * @return \Emitente\Entity\Emitente
	 */
	public function setRazao($razao)
	{
		$this->razao = $razao;	
	}
	
	/**
	 * Returns titulo.
	 */
	public function getFantasia()
	{
	    return $this->fantasia;
	}
	
	/**
	 * Sets titulo.
	 * @param string $fantasia
	 * @return \Emitente\Entity\Emitente
	 */
	public function setFantasia($fantasia)
	{
	    $this->fantasia = $fantasia;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getCnpj()
	{
	    return $this->cnpj;
	}
	
	/**
	 * Sets titulo.
	 * @param string $cnpj
	 * @return \Emitente\Entity\Emitente
	 */
	public function setCnpj($cnpj)
	{
	    $this->cnpj = $cnpj;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getIe()
	{
	    return $this->ie;
	}
	
	/**
	 * Sets titulo.
	 * @param string $ie
	 * @return \Emitente\Entity\Emitente
	 */
	public function setIe($ie)
	{
	    $this->ie = $ie;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getCnae()
	{
	    return $this->cnae;
	}
	
	/**
	 * Sets titulo.
	 * @param string $cnae
	 * @return \Emitente\Entity\Emitente
	 */
	public function setCnae($cnae)
	{
	    $this->cnae = $cnae;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getIm()
	{
	    return $this->im;
	}
	
	/**
	 * Sets titulo.
	 * @param string $im
	 * @return \Emitente\Entity\Emitente
	 */
	public function setIm($im)
	{
	    $this->im = $im;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getIest()
	{
	    return $this->iest;
	}
	
	/**
	 * Sets titulo.
	 * @param string $iest
	 * @return \Emitente\Entity\Emitente
	 */
	public function setIest($iest)
	{
	    $this->iest = $iest;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getLogradouro()
	{
	    return $this->logradouro;
	}
	
	/**
	 * Sets titulo.
	 * @param string $logradouro
	 * @return \Emitente\Entity\Emitente
	 */
	public function setLogradouro($logradouro)
	{
	    $this->logradouro = $logradouro;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getNumero()
	{
	    return $this->numero;
	}
	
	/**
	 * Sets titulo.
	 * @param string $numero
	 * @return \Emitente\Entity\Emitente
	 */
	public function setNumero($numero)
	{
	    $this->numero = $numero;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getComplemento()
	{
	    return $this->complemento;
	}
	
	/**
	 * Sets titulo.
	 * @param string $complemento
	 * @return \Emitente\Entity\Emitente
	 */
	public function setComplemento($complemento)
	{
	    $this->complemento = $complemento;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getBairro()
	{
	    return $this->bairro;
	}
	
	/**
	 * Sets titulo.
	 * @param string $bairro
	 * @return \Emitente\Entity\Emitente
	 */
	public function setBairro($bairro)
	{
	    $this->bairro = $bairro;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getCep()
	{
	    return $this->cep;
	}
	
	/**
	 * Sets titulo.
	 * @param string $cep
	 * @return \Emitente\Entity\Emitente
	 */
	public function setCep($cep)
	{
	    $this->cep = $cep;
	}
	
	
	/**
	 * Returns titulo.
	 */
	public function getPaisId()
	{
	    return $this->pais_id;
	}
	
	/**
	 * Sets titulo.
	 * @param string $ie
	 * @return \Emitente\Entity\Emitente
	 */
	public function setPaisId($pais_id)
	{
	    $this->pais_id = $pais_id;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getMunicipioId()
	{
	    return $this->municipio_id;
	}
	
	/**
	 * Sets titulo.
	 * @param string $ie
	 * @return \Emitente\Entity\Emitente
	 */
	public function setMunicipioId($municipio_id)
	{
	    $this->municipio_id = $municipio_id;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getTelefone()
	{
	    return $this->telefone;
	}
	
	/**
	 * Sets titulo.
	 * @param string $ie
	 * @return \Emitente\Entity\Emitente
	 */
	public function setTelefone($telefone)
	{
	    $this->telefone = $telefone;
	}
	/**
	 * Gets triggered only on insert
	 * @ORM\PrePersist
	 */
	public function onPrePersist()
	{
		$this->dataCadastro = date('Y-m-d');
		$this->dataAltera = date('Y-m-d');
	}
	
	/**
	 * Gets triggered every time on update
	 * @ORM\PreUpdate
	 */
	public function onPreUpdate()
	{
		$this->dataAltera = date('Y-m-d');
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