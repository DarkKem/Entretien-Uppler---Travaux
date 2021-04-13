<?php

namespace App\Model;

use App\Entity\User;

interface Post{
    
    public function getCreatedAt(): ?\DateTimeInterface;
    public function setCreatedAt(\DateTimeInterface $createdAt): self;
    public function getDateModification(): ?\DateTimeInterface;
    public function setDateModification(\DateTimeInterface $dateModification): self;
    public function getAuteur(): ?User;
    public function setAuteur(?User $auteur): self;
}
