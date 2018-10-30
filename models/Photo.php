<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "photos".
 *
 * @property int $id
 * @property string $photo
 * @property string $caption
 * @property string $author
 */
class Photo extends ActiveRecord
{

    public const MAX_HEIGHT = 600;
    public const MAX_WIDTH = 600;

    /** @var UploadedFile */
    private $uploadedFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'photos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['photo', 'caption', 'author'], 'required'],
            [['uploadedFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
            [['caption', 'photo'], 'string'],
            [['author'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'photo' => 'Photo',
            'caption' => 'Caption',
            'author' => 'Author',
        ];
    }

    public function afterDelete()
    {
        @unlink($this->getFullSrc());

        parent::afterDelete();
    }

    /**
     * @return string
     */
    private function generateFileName(): string
    {
        return Yii::$app->security->generateRandomString();
    }

    /**
     * @return string
     */
    public function getFullSrc(): string
    {
        return Yii::getAlias('@photo') . '/' . $this->photo;
    }

    public function setUploadedFile()
    {
        $this->uploadedFile = UploadedFile::getInstance($this, 'uploadedFile');
        $fileName = $this->generateFileName() . '.' . $this->uploadedFile->getExtension();
        $this->photo = $fileName;
    }

    /**
     * @return null|UploadedFile
     */
    public function getUploadedFile(): ?UploadedFile
    {
        return $this->uploadedFile;
    }

    /**
     * @return void
     */
    public function saveUploadedFile(): void
    {
        if (!$this->uploadedFile->saveAs($this->getFullSrc())) {
            throw new \RuntimeException('Unable to save file');
        }
    }
}
