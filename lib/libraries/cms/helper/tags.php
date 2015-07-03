<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Helper
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

/**
 * Tags helper class, provides methods to perform various tasks relevant
 * tagging of content.
 *
 * @package     Joomla.Libraries
 * @subpackage  Helper
 * @since       3.1
 */
class JHelperTags extends JHelper
{
    /**
     * Method to add tag rows to mapping table.
     *
     * @param   integer          $ucmId  ID of the #__ucm_content item being tagged
     * @param   JTableInterface  $table  JTable object being tagged
     * @param   array            $tags   Array of tags to be applied.
     *
     * @return  boolean  true on success, otherwise false.
     *
     * @since   3.1
     */
    public function addTagMapping($ucmId, JTableInterface $table, $tags = array())
    {
       return false;
    }

    /**
     * Function that converts tags paths into paths of names
     *
     * @param   array  $tags  Array of tags
     *
     * @return  array
     *
     * @since   3.1
     */
    public static function convertPathsToNames($tags)
    {
        return array();
    }

    /**
     * Create any new tags by looking for #new# in the strings
     *
     * @param   array  $tags  Tags text array from the field
     *
     * @return  mixed   If successful, metadata with new tag titles replaced by tag ids. Otherwise false.
     *
     * @since   3.1
     */
    public function createTagsFromField($tags)
    {
        return false;
    }

    /**
     * Method to delete the tag mappings and #__ucm_content record for for an item
     *
     * @param   JTableInterface  $table          JTable object of content table where delete occurred
     * @param   integer          $contentItemId  ID of the content item.
     *
     * @return  boolean  true on success, false on failure
     *
     * @since   3.1
     */
    public function deleteTagData(JTableInterface $table, $contentItemId)
    {
       return false;
    }

    /**
     * Method to get a list of tags for an item, optionally with the tag data.
     *
     * @param   integer  $contentType  Content type alias. Dot separated.
     * @param   integer  $id           Id of the item to retrieve tags for.
     * @param   boolean  $getTagData   If true, data from the tags table will be included, defaults to true.
     *
     * @return  array    Array of of tag objects
     *
     * @since   3.1
     */
    public function getItemTags($contentType, $id, $getTagData = true)
    {
        return array();
    }

    /**
     * Method to get a list of tags for a given item.
     * Normally used for displaying a list of tags within a layout
     *
     * @param   mixed   $ids     The id or array of ids (primary key) of the item to be tagged.
     * @param   string  $prefix  Dot separated string with the option and view to be used for a url.
     *
     * @return  string   Comma separated list of tag Ids.
     *
     * @since   3.1
     */
    public function getTagIds($ids, $prefix)
    {
        return '';
    }

    /**
     * Method to get a query to retrieve a detailed list of items for a tag.
     *
     * @param   mixed    $tagId            Tag or array of tags to be matched
     * @param   mixed    $typesr           Null, type or array of type aliases for content types to be included in the results
     * @param   boolean  $includeChildren  True to include the results from child tags
     * @param   string   $orderByOption    Column to order the results by
     * @param   string   $orderDir         Direction to sort the results in
     * @param   boolean  $anyOrAll         True to include items matching at least one tag, false to include
     *                                     items all tags in the array.
     * @param   string   $languageFilter   Optional filter on language. Options are 'all', 'current' or any string.
     * @param   string   $stateFilter      Optional filtering on publication state, defaults to published or unpublished.
     *
     * @return  JDatabaseQuery  Query to retrieve a list of tags
     *
     * @since   3.1
     */
    public function getTagItemsQuery($tagId, $typesr = null, $includeChildren = false, $orderByOption = 'c.core_title', $orderDir = 'ASC',
                                     $anyOrAll = true, $languageFilter = 'all', $stateFilter = '0,1')
    {
       return null;
    }

    /**
     * Function that converts tag ids to their tag names
     *
     * @param   array  $tagIds  Array of integer tag ids.
     *
     * @return  array  An array of tag names.
     *
     * @since   3.1
     */
    public function getTagNames($tagIds)
    {
        return array();
    }

    /**
     * Method to get an array of tag ids for the current tag and its children
     *
     * @param   integer  $id             An optional ID
     * @param   array    &$tagTreeArray  Array containing the tag tree
     *
     * @return  mixed
     *
     * @since   3.1
     */
    public function getTagTreeArray($id, &$tagTreeArray = array())
    {
        return array();
    }

    /**
     * Method to get the type id for a type alias.
     *
     * @param   string  $typeAlias  A type alias.
     *
     * @return  string  Name of the table for a type
     *
     * @since   3.1
     * @deprecated  4.0  Use JUcmType::getTypeId() instead
     */
    public function getTypeId($typeAlias)
    {
        return '';
    }

    /**
     * Method to get a list of types with associated data.
     *
     * @param   string   $arrayType    Optionally specify that the returned list consist of objects, associative arrays, or arrays.
     *                                 Options are: rowList, assocList, and objectList
     * @param   array    $selectTypes  Optional array of type ids to limit the results to. Often from a request.
     * @param   boolean  $useAlias     If true, the alias is used to match, if false the type_id is used.
     *
     * @return  array   Array of of types
     *
     * @since   3.1
     */
    public static function getTypes($arrayType = 'objectList', $selectTypes = null, $useAlias = true)
    {
        return array();
    }

    /**
     * Function that handles saving tags used in a table class after a store()
     *
     * @param   JTableInterface  $table    JTable being processed
     * @param   array            $newTags  Array of new tags
     * @param   boolean          $replace  Flag indicating if all exising tags should be replaced
     *
     * @return  boolean
     *
     * @since   3.1
     */
    public function postStoreProcess(JTableInterface $table, $newTags = array(), $replace = true)
    {
        return false;
    }

    /**
     * Function that preProcesses data from a table prior to a store() to ensure proper tag handling
     *
     * @param   JTableInterface  $table    JTable being processed
     * @param   array            $newTags  Array of new tags
     *
     * @return  null
     *
     * @since   3.1
     */
    public function preStoreProcess(JTableInterface $table, $newTags = array())
    {
        return null;
    }

    /**
     * Function to search tags
     *
     * @param   array  $filters  Filter to apply to the search
     *
     * @return  array
     *
     * @since   3.1
     */
    public static function searchTags($filters = array())
    {
        return array();
    }

    /**
     * Method to delete all instances of a tag from the mapping table. Generally used when a tag is deleted.
     *
     * @param   integer  $tag_id  The tag_id (primary key) for the deleted tag.
     *
     * @return  void
     *
     * @since   3.1
     */
    public function tagDeleteInstances($tag_id)
    {

    }

    /**
     * Method to add or update tags associated with an item.
     *
     * @param   integer          $ucmId    Id of the #__ucm_content item being tagged
     * @param   JTableInterface  $table    JTable object being tagged
     * @param   array            $tags     Array of tags to be applied.
     * @param   boolean          $replace  Flag indicating if all exising tags should be replaced
     *
     * @return  boolean  true on success, otherwise false.
     *
     * @since   3.1
     */
    public function tagItem($ucmId, JTableInterface $table, $tags = array(), $replace = true)
    {
        return false;
    }

    /**
     * Method to untag an item
     *
     * @param   integer          $contentId  ID of the content item being untagged
     * @param   JTableInterface  $table      JTable object being untagged
     * @param   array            $tags       Array of tags to be untagged. Use an empty array to untag all existing tags.
     *
     * @return  boolean  true on success, otherwise false.
     *
     * @since   3.1
     */
    public function unTagItem($contentId, JTableInterface $table, $tags = array())
    {
       return false;
    }
}
