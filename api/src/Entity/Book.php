<?php
// api/src/Entity/Book.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A book.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Book
{
    /**
     * @var int The id of this book.
     *
     * @ApiProperty(identifier=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null The ISBN of this book (or null if doesn't have one).
     *
     * @ORM\Column(nullable=true)
     * @Assert\Isbn
     */
    public $isbn;

    /**
     * @var string The title of this book.
     *
     * @ORM\Column
     */
    public $title;

    /**
     * @var string The description of this book.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $description;

    /**
     * @var string The author of this book.
     *
     * @ORM\Column
     */
    public $author;

    /**
     * @var \DateTimeInterface The publication date of this book.
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    public $publicationDate;

    /**
     * @var Review[] Available reviews for this book.
     *
     * @ORM\OneToMany(targetEntity="Review", mappedBy="book", cascade={"persist", "remove"})
     * @Assert\NotNull
     */
    public $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $newid)
    {
        $this->id = $newid;
    }
}
