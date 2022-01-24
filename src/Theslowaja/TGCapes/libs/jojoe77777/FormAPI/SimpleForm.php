<?php

declare(strict_types = 1);

namespace Theslowaja\TGCapes\libs\jojoe77777\FormAPI;

class SimpleForm extends Form {

    const IMAGE_TYPE_PATH = 0;
    const IMAGE_TYPE_URL = 1;

    /** @var string */
    private string $content = "";

    private array $labelMap = [];

    /**
     * @param callable|null $callable
     */
    public function __construct(?callable $callable) {
        parent::__construct($callable);
        $this->data["type"] = "form";
        $this->data["title"] = "";
        $this->data["content"] = $this->content;
        $this->data["buttons"] = [];
    }

    public function processData(&$data) : void {
        $data = $this->labelMap[$data] ?? null;
    }

    /**
     * @param string $title
     * @return SimpleForm
     */
    public function setTitle(string $title) : self {
        $this->data["title"] = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle() : string {
        return $this->data["title"];
    }

    /**
     * @return string
     */
    public function getContent() : string {
        return $this->data["content"];
    }

    /**
     * @param string $content
     * @return SimpleForm
     */
    public function setContent(string $content) : self {
        $this->data["content"] = $content;
        return $this;
    }

    /**
     * @param string $text
     * @param int $imageType
     * @param string $imagePath
     * @param string|null $label
     * @return SimpleForm
     */
    public function addButton(string $text, int $imageType = -1, string $imagePath = "", ?string $label = null) : self {
        $content = ["text" => $text];
        if($imageType !== -1) {
            $content["image"]["type"] = $imageType === 0 ? "path" : "url";
            $content["image"]["data"] = $imagePath;
        }
        $this->data["buttons"][] = $content;
        $this->labelMap[] = $label ?? count($this->labelMap);
        return $this;
    }

}
