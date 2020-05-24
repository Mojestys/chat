<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messages
 *
 * @ORM\Table(name="messages", uniqueConstraints={@ORM\UniqueConstraint(name="sender_user_id", columns={"sender_user_id", "dialog_id"})}, indexes={@ORM\Index(name="dialog_id", columns={"dialog_id"}), @ORM\Index(name="IDX_DB021E962A98155E", columns={"sender_user_id"})})
 * @ORM\Entity
 */
class Messages
{
    /**
     * @var int
     *
     * @ORM\Column(name="message_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $messageId;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=32, nullable=false)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="message_date", type="datetime", nullable=false)
     */
    private $messageDate;

    /**
     * @var \Dialogs
     *
     * @ORM\ManyToOne(targetEntity="Dialogs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dialog_id", referencedColumnName="dialog_id")
     * })
     */
    private $dialog;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sender_user_id", referencedColumnName="user_id")
     * })
     */
    private $senderUser;

    public function getMessageId(): ?int
    {
        return $this->messageId;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getMessageDate(): ?\DateTimeInterface
    {
        return $this->messageDate;
    }

    public function setMessageDate(\DateTimeInterface $messageDate): self
    {
        $this->messageDate = $messageDate;

        return $this;
    }

    public function getDialog(): ?Dialogs
    {
        return $this->dialog;
    }

    public function setDialog(?Dialogs $dialog): self
    {
        $this->dialog = $dialog;

        return $this;
    }

    public function getSenderUser(): ?Users
    {
        return $this->senderUser;
    }

    public function setSenderUser(?Users $senderUser): self
    {
        $this->senderUser = $senderUser;

        return $this;
    }


}
