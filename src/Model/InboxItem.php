<?php
declare(strict_types=1);
namespace NapoleonCat\Model;

class InboxItem
{
    private string $item_id;
    private ?string $item_parent = null;
    private ?string $item_parent_parent = null;
    private string $page_social_id;
    private ?string $author_social_id = null;
    private int $item_type;
    private int $created_at;
    private ?int $updated_at = 0;
    private string $data;
    private ?InboxItemCollection $child = null;

    /**
     * @param string $item_id
     * @return InboxItem
     */
    public function setItemId(string $item_id): InboxItem
    {
        $this->item_id = $item_id;
        return $this;
    }

    /**
     * @param string|null $item_parent
     * @return InboxItem
     */
    public function setItemParent(?string $item_parent): InboxItem
    {
        $this->item_parent = $item_parent;
        return $this;
    }

    /**
     * @param string|null $item_parent_parent
     * @return InboxItem
     */
    public function setItemParentParent(?string $item_parent_parent): InboxItem
    {
        $this->item_parent_parent = $item_parent_parent;
        return $this;
    }


    /**
     * @param string $page_social_id
     * @return InboxItem
     */
    public function setPageSocialId(string $page_social_id): InboxItem
    {
        $this->page_social_id = $page_social_id;
        return $this;
    }

    /**
     * @param ?string $author_social_id
     * @return InboxItem
     */
    public function setAuthorSocialId(?string $author_social_id): InboxItem
    {
        $this->author_social_id = $author_social_id;
        return $this;
    }

    /**
     * @param int $item_type
     * @return InboxItem
     */
    public function setItemType(int $item_type): InboxItem
    {
        $this->item_type = $item_type;
        return $this;
    }

    /**
     * @param int $created_at
     * @return InboxItem
     */
    public function setCreatedAt(int $created_at): InboxItem
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @param int|null $updated_at
     * @return InboxItem
     */
    public function setUpdatedAt(?int $updated_at): InboxItem
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @param string $data
     * @return InboxItem
     */
    public function setData(string $data): InboxItem
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemId(): string
    {
        return $this->item_id;
    }

    /**
     * @return string|null
     */
    public function getItemParent(): ?string
    {
        return $this->item_parent;
    }

    /**
     * @return string|null
     */
    public function getItemParentParent(): ?string
    {
        return $this->item_parent_parent;
    }

    /**
     * @return string
     */
    public function getPageSocialId(): string
    {
        return $this->page_social_id;
    }

    /**
     * @return string
     */
    public function getAuthorSocialId(): string
    {
        return $this->author_social_id;
    }

    /**
     * @return int
     */
    public function getItemType(): int
    {
        return $this->item_type;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAt(): ?int
    {
        return $this->updated_at;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return null|InboxItemCollection
     */
    public function getChild(): ?InboxItemCollection
    {
        return $this->child;
    }

    /**
     * @param null|InboxItemCollection $child
     * @return InboxItem
     */
    public function setChild(?InboxItemCollection $child): InboxItem
    {
        $this->child = $child;
        return $this;
    }

}