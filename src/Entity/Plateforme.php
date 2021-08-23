<?php

namespace App\Entity;

use DateTimeImmutable;
use App\Repository\PlateformeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=PlateformeRepository::class)
 * @Vich\Uploadable
 */
class Plateforme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="jeuxvideo_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Jeuxvideo::class, mappedBy="plateforme")
     */
    private $jeuxvideo;

    public function __construct()
    {
        $this->image = new EmbeddedFile();
        $this->jeuxvideo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImage(EmbeddedFile $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?EmbeddedFile
    {
        return $this->image;
    }

    /**
     * @return Collection|Jeuxvideo[]
     */
    public function getJeuxvideo(): Collection
    {
        return $this->jeuxvideo;
    }

    public function addJeuxvideo(Jeuxvideo $jeuxvideo): self
    {
        if (!$this->jeuxvideo->contains($jeuxvideo)) {
            $this->jeuxvideo[] = $jeuxvideo;
            $jeuxvideo->setPlateforme($this);
        }

        return $this;
    }

    public function removeJeuxvideo(Jeuxvideo $jeuxvideo): self
    {
        if ($this->jeuxvideo->removeElement($jeuxvideo)) {
            // set the owning side to null (unless already changed)
            if ($jeuxvideo->getPlateforme() === $this) {
                $jeuxvideo->setPlateforme(null);
            }
        }

        return $this;
    }
}
