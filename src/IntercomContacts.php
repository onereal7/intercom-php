<?php

namespace Intercom;

use Http\Client\Exception;
use stdClass;

class IntercomContacts extends IntercomResource
{
    /**
     * Creates a Contact.
     *
     * @see    https://developers.intercom.com/intercom-api-reference/reference#create-contact
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function create(array $options)
    {
        return $this->client->post("contacts", $options);
    }

    /**
     * Updates a Contact.
     *
     * @see    https://developers.intercom.com/intercom-api-reference/reference#update-contact
     * @param  string $id
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function update(string $id, array $options)
    {
        $path = $this->contactPath($id);
        return $this->client->put($path, $options);
    }

    /**
     * Lists Contacts.
     *
     * @see    https://developers.intercom.com/intercom-api-reference/reference#list-contacts
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function getContacts(array $options = [])
    {
        return $this->client->get('contacts', $options);
    }

    /**
     * Gets a single Contact based on the Intercom ID.
     *
     * @see    https://developers.intercom.com/intercom-api-reference/reference#get-contact
     * @param  string $id
     * @param  array  $options
     * @return stdClass
     * @throws Exception
     */
    public function getContact(string $id, array $options = [])
    {
        $path = $this->contactPath($id);
        return $this->client->get($path, $options);
    }

    /**
     * Permenently Deletes (schedules for deletion) a single Contact based on the Intercom ID.
     * Note that afterwards there will be 7-day grace period during which data still can be retrieved.
     * During this period contact with the same data cannot be created or contact unarchived.
     *
     * @see    https://developers.intercom.com/intercom-api-reference/reference#delete-contact
     * @param  string $id
     * @param  array  $options
     * @return stdClass
     * @throws Exception
     */
    public function deleteContact(string $id, array $options = [])
    {
        $path = $this->contactPath($id);
        return $this->client->delete($path, $options);
    }

    /**
     * Archives a single Contact based on the Intercom ID.
     *
     * @see    https://developers.intercom.com/intercom-api-reference/reference#archive-a-contact
     * @param  string $id
     * @param  array  $options
     * @return stdClass
     * @throws Exception
     */
    public function archiveContact(string $id, array $options = [])
    {
        $path = $this->contactPath($id) . '/archive';
        return $this->client->post($path, $options);
    }

    /**
     * Unarchives a single Contact based on the Intercom ID.
     *
     * @see    https://developers.intercom.com/intercom-api-reference/reference#unarchive-a-contact
     * @param  string $id
     * @param  array  $options
     * @return stdClass
     * @throws Exception
     */
    public function unarchiveContact(string $id, array $options = [])
    {
        $path = $this->contactPath($id) . '/unarchive';
        return $this->client->post($path, $options);
    }

    /**
     * Returns list of Contacts that match search query.
     *
     * @see     https://developers.intercom.com/reference#search-for-contacts
     * @param   array $options
     * @return  stdClass
     * @throws  Exception
     */
    public function search(array $options)
    {
        $path = 'contacts/search';
        return $this->client->post($path, $options);
    }

    /**
     * Returns next page of Contacts that match search query.
     *
     * @see     https://developers.intercom.com/intercom-api-reference/reference#pagination-search
     * @param   array $query
     * @param   stdClass $pages
     * @return  stdClass
     * @throws  Exception
     */
    public function nextSearch(array $query, $pages)
    {
        $path = 'contacts/search';
        return $this->client->nextSearchPage($path, $query, $pages);
    }

    /**
     * Returns next page of a Contacts list.
     *
     * @see     https://developers.intercom.com/intercom-api-reference/reference#pagination
     * @param   stdClass $pages
     * @param   array $options
     * @return  stdClass
     * @throws  Exception
     */
    public function nextCursor($pages, array $options = [])
    {
        $path = 'contacts';
        $starting_after = $pages->next->starting_after;
        return $this->client->nextCursorPage($path, $starting_after, $options);
    }

    /**
     * @param string $id
     * @return string
     */
    public function contactPath(string $id)
    {
        return 'contacts/' . $id;
    }
}
