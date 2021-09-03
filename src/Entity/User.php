<?php

namespace App\Entity;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex;
/**
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 *  @ORM\Entity
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email",
 *    message="Cet email est déja utilisé" )
 */
 class User implements UserInterface
                                       {
                                           /**
                                            * @ORM\Id
                                            * @ORM\GeneratedValue
                                            * @ORM\Column(type="integer")
                                            */
                                           private $id;
                                       
                                           /**
                                            * @ORM\Column(type="string", length=255 )
                                            */
                                           private $nom;
                                       
                                           /**
                                            * @ORM\Column(type="string", length=255)
                                            */
                                           private $prenom;
                                       
                                           /**
                                            * @ORM\Column(type="string", length=255 , unique=true )
                                            */
                                           private $email;
                                       
                                           /**
                                            * @ORM\Column(type="string", length=255)
                                            */
                                           private $mdp;
                                       
                                           /**
                                            * @ORM\Column(type="string", length=255)
                                            */
                                           private $territoire;
                                       
                                           /**
                                            * @ORM\Column(type="integer")
                                            */
                                           private $role;
                                           /**
                                           * @ORM\Column(type="string", length=255)
                                           */


                                           private $image;
                                       
                                           public function getId(): ?int
                                           {
                                               return $this->id;
                                           }
                                       
                                           public function getNom(): ?string
                                           {
                                               return $this->nom;
                                           }
                                       
                                           public function setNom(string $nom): self
                                           {
                                               $this->nom = $nom;
                                       
                                               return $this;
                                           }
                                       
                                           public function getPrenom(): ?string
                                           {
                                               return $this->prenom;
                                           }
                                       
                                           public function setPrenom(string $prenom): self
                                           {
                                               $this->prenom = $prenom;
                                       
                                               return $this;
                                           }
                                       
                                           public function getEmail(): ?string
                                           {
                                               return $this->email;
                                           }
                                       
                                           public function setEmail(string $email): self
                                           {
                                               $this->email = $email;
                                       
                                               return $this;
                                           }
                                       
                                           public function getMdp(): ?string
                                           {
                                               return $this->mdp;
                                           }
                                       
                                           public function setMdp(string $mdp): self
                                           {
                                               $this->mdp = $mdp;
                                       
                                               return $this;
                                           }
                                       
                                           public function getTerritoire(): ?string
                                           {
                                               return $this->territoire;
                                           }
                                       
                                           public function setTerritoire(string $territoire): self
                                           {
                                               $this->territoire = $territoire;
                                       
                                               return $this;
                                           }
                                       
                                           public function getRole(): ?int
                                           {
                                               return $this->role;
                                           }
                                       
                                           public function setRole(int $role): self
                                           {
                                               $this->role = $role;
                                       
                                               return $this;
                                           }
                                       
                                            public function getRoles()
                                            {
                                       
                                                if( $this ->role == 0) {
         
                                                        return ['ROLE_USER'];
                                       
         
                                                }
                                                else if($this->role)
                                                {
                                                    return ['ROLE_ADMIN'];
                                                }
                                            }
                                       public function getPassword()
                                        {
                                            return $this->getMdp();
                                        }
                                        public function getSalt()
                                        {
                                            // TODO: Implement getSalt() method.
                                        }public function getUsername()
                                        {
                                            return $this->email;
                                        }public function eraseCredentials()
                                        {
                                            // TODO: Implement eraseCredentials() method.
                                        }
                        

                                        public function getImage(): ?string
                                        {
                                            return $this->image;
                                        }

                                        public function setImage(string $image): self
                                        {
                                            $this->image = $image;

                                            return $this;
                                        }
                                           }
