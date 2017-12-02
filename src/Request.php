<?php

namespace Akizuki\ServCon;


use Strict\Property\Utility\ReadonlyPropertyContainer;

/**
 * [ Container ] Server Values Container
 *
 * @author katayose
 * @copyright 2017 4kizuki. All Rights Reserved.
 * @package 4kizuki/servcon
 * @since 1.0.0
 *
 * @property-read ServCon $server
 * @property-read GetCon $get
 * @property-read PostCon $post
 * @property-read CookieCon $cookie
 * @property-read FileCon $files
 */
class Request extends ReadonlyPropertyContainer
{
    public function __construct(array $server, array $get, array $post, array $cookie, array $files)
    {
        $this->setReadonlyProperty('server', new ServCon($server));
        $this->setReadonlyProperty('get', new GetCon($get));
        $this->setReadonlyProperty('post', new PostCon($post));
        $this->setReadonlyProperty('cookie', new CookieCon($cookie));
        $this->setReadonlyProperty('files', new FileCon($files));
    }

}
