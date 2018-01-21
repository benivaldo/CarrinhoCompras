<?php
namespace ProdutoCategoria\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoCategoria
 *
 * @ORM\Table(name="produto_categoria", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"}), @ORM\UniqueConstraint(name="produto_codigo", columns={"produto_codigo", "categoria_nome"})}, indexes={@ORM\Index(name="categoria_nome", columns={"categoria_nome"}), @ORM\Index(name="IDX_D5E7E35CAB3F6EF8", columns={"produto_codigo"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="ProdutoCategoria\Repository\ProdutoCategoriaRepository")
 */
class ProdutoCategoria
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto\Entity\Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto_codigo", referencedColumnName="codigo")
     * })
     */
    private $produtoCodigo;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria\Entity\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_nome", referencedColumnName="nome")
     * })
     */
    private $categoriaNome;



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
     * Set produtoCodigo.
     *
     * @param \Produto|null $produtoCodigo
     *
     * @return ProdutoCategoria
     */
    public function setProdutoCodigo(\Produto\Entity\Produto $produtoCodigo = null)
    {
        $this->produtoCodigo = $produtoCodigo;

        return $this;
    }

    /**
     * Get produtoCodigo.
     *
     * @return \Produtos|null
     */
    public function getProdutoCodigo()
    {
        return $this->produtoCodigo;
    }

    /**
     * Set categoriaNome.
     *
     * @param \Categorias|null $categoriaNome
     *
     * @return ProdutoCategoria
     */
    public function setCategoriaNome(\Categoria\Entity\Categoria $categoriaNome = null)
    {
        $this->categoriaNome = $categoriaNome;

        return $this;
    }

    /**
     * Get categoriaNome.
     *
     * @return \Categorias|null
     */
    public function getCategoriaNome()
    {
        return $this->categoriaNome;
    }
}
