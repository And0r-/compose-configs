<?php

/**
 * This is just a handful of additional settings that need to overwrite the default nextcloud settings
 */

$CONFIG = [

/**
 * User Experience
 *
 * These optional parameters control some aspects of the user interface. Default
 * values, where present, are shown.
 */

/**
 * The directory where the skeleton files are located. These files will be
 * copied to the data directory of new users. Leave empty to not copy any
 * skeleton files.
 * ``{lang}`` can be used as a placeholder for the language of the user.
 * If the directory does not exist, it falls back to non dialect (from ``de_DE``
 * to ``de``). If that does not exist either, it falls back to ``default``
 *
 * Defaults to ``core/skeleton`` in the Nextcloud directory.
 */
'skeletondirectory' => '',

/**
 * The directory where the template files are located. These files will be
 * copied to the template directory of new users. Leave empty to not copy any
 * template files.
 * ``{lang}`` can be used as a placeholder for the language of the user.
 * If the directory does not exist, it falls back to non dialect (from ``de_DE``
 * to ``de``). If that does not exist either, it falls back to ``default``
 *
 * If this is not set creating a template directory will only happen if no custom
 * ``skeletondirectory`` is defined, otherwise the shipped templates will be used
 * to create a template directory for the user.
 */
'templatedirectory' => '',

/**
 * If your user backend does not allow password resets (e.g. when it's a
 * read-only user backend like LDAP), you can specify a custom link, where the
 * user is redirected to, when clicking the "reset password" link after a failed
 * login-attempt.
 * In case you do not want to provide any link, replace the url with 'disabled'
 */
'lost_password_link' => 'disabled',


];
