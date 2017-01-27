<?php
/**
 * @package     Joomla.Platform
 * @subpackage  HTTP
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * HTTP response data object class.
 *
 * @since  11.3
 */
class JHttpResponse
{
	/**
	 * @var    integer  The server response code.
	 * @since  11.3
	 */
	public $code;

	/**
	 * @var    array  Response headers.
	 * @since  11.3
	 */
	public $headers = array();

	/**
	 * @var    string  Server response body.
	 * @since  11.3
	 */
	public $body;

    // [Successful 2xx]
    const OK                            = 200;
    const CREATED                       = 201;
    const ACCEPTED                      = 202;
    const NO_CONTENT                    = 204;
    const RESET_CONTENT                 = 205;
    const PARTIAL_CONTENT               = 206;

    // [Redirection 3xx]
    const MOVED_PERMANENTLY             = 301;
    const FOUND                         = 302;
    const SEE_OTHER                     = 303;
    const NOT_MODIFIED                  = 304;
    const USE_PROXY                     = 305;
    const TEMPORARY_REDIRECT            = 307;

    // [Client Error 4xx]
    const BAD_REQUEST                   = 400;
    const UNAUTHORIZED                  = 401;
    const FORBIDDEN                     = 403;
    const NOT_FOUND                     = 404;
    const METHOD_NOT_ALLOWED            = 405;
    const NOT_ACCEPTABLE                = 406;
    const REQUEST_TIMEOUT               = 408;
    const CONFLICT                      = 409;
    const GONE                          = 410;
    const LENGTH_REQUIRED               = 411;
    const PRECONDITION_FAILED           = 412;
    const REQUEST_ENTITY_TOO_LARGE      = 413;
    const REQUEST_URI_TOO_LONG          = 414;
    const UNSUPPORTED_MEDIA_TYPE        = 415;
    const REQUESTED_RANGE_NOT_SATISFIED = 416;
    const EXPECTATION_FAILED            = 417;

    // [Server Error 5xx]
    const INTERNAL_SERVER_ERROR         = 500;
    const NOT_IMPLEMENTED               = 501;
    const BAD_GATEWAY                   = 502;
    const SERVICE_UNAVAILABLE           = 503;
    const GATEWAY_TIMEOUT               = 504;
    const VERSION_NOT_SUPPORTED         = 505;

    /**
     * Status codes translation table.
     *
     * The list of codes is complete according to the
     * {@link http://www.iana.org/assignments/http-status-codes/ Hypertext Transfer Protocol (HTTP) Status Code Registry}
     * (last updated 2012-02-13).
     *
     * Unless otherwise noted, the status code is defined in RFC2616.
     *
     * @var array
     */
    public static $status_messages = array(

        // [Successful 2xx]
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        // [Redirection 3xx]
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',

        // [Client Error 4xx]
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',

        // [Server Error 5xx]
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Object Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    );
}
