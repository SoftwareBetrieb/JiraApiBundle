<?php

namespace JiraApiBundle\Service;

/**
 * Service class that manages issues.
 */
class IssueService extends AbstractService
{

    const BASE_URL = '/rest/api/latest/';

    /**
     * Retrieve details for a specific issue.
     *
     * @param string $key
     *
     * @return array
     */
    public function get($key)
    {
        return $this->performQuery(
            $this->createUrl(
                sprintf(self::BASE_URL.'issue/%s', $key)
            )
        );
    }


    public function create($data)
    {
        return $this->postData(self::BASE_URL.'issue', json_encode($data));
    }


    public function addFile($issueKey, $fileName, $fileContent)
    {
        return $this->postFile(
            $this->createUrl(
                sprintf(self::BASE_URL.'issue/%s/attachments', $issueKey)
            ),
            array(
                'file' => array(
                    'filename' => $fileName,
                    'contents' => $fileContent,
                )
            )
        );
    }


    public function addGrid($gridId, $issueKey, $data)
    {
        return $this->postData(
            $this->createUrl(
                sprintf('/rest/idalko-igrid/1.0/grid/%s/issue/%s', $gridId, $issueKey)
            ),
            json_encode($data)
        );
    }

}
