<?php

namespace ESD\Plugins\Ding;

/**
 * Class Ding
 * @package ESD\Plugins\Ding
 */
class Ding extends Base
{

    /**
     * 发送文本消息
     * @param string $content 消息内容
     * @param array $mobiles 被@人的手机号(在content里添加@人的手机号)
     * @param bool $isAtAll @所有人时：true，否则为：false
     *
     * @return void
     *
     */
    public function sendText($content, $mobiles = [], $isAtAll = false)
    {
        $data = [
            'msgtype' => 'text',
            'text'    => [
                'content' => $content
            ],
            'at'      => [
                'atMobiles' => $mobiles,
                'isAtAll'   => $isAtAll
            ]
        ];
        $this->send($data);
    }

    /**
     * 发送链接消息
     * @param string $title 消息标题
     * @param string $text 消息内容。如果太长只会部分展示
     * @param string $messageUrl 点击消息跳转的URL
     * @param string $picUrl 图片URL
     *
     * @return void
     *
     */
    public function sendLink($title, $text, $messageUrl, $picUrl = '')
    {
        $data = [
            'msgtype' => 'link',
            'link'    => [
                'title'      => $title,
                'text'       => $text,
                'messageUrl' => $messageUrl,
                'picUrl'     => $picUrl,
            ]
        ];
        $this->send($data);
    }

    /**
     * 发送Markdown消息
     * @param string $title 首屏会话透出的展示内容
     * @param string $text markdown格式的消息
     * @param array $mobiles 被@人的手机号(在content里添加@人的手机号)
     * @param bool $isAtAll @所有人时：true，否则为：false
     *
     * @return void
     *
     */
    public function sendMarkdown($title, $text, $mobiles = [], $isAtAll = false)
    {
        $data = [
            'msgtype'  => 'markdown',
            'markdown' => [
                'title' => $title,
                'text'  => $text,
            ],
            'at'       => [
                'atMobiles' => $mobiles,
                'isAtAll'   => $isAtAll
            ]
        ];
        $this->send($data);
    }

    /**
     * 发送ActionCard
     * @param string $title 首屏会话透出的展示内容
     * @param string $text markdown格式的消息
     * @param array $btns 按钮，每个元素包含 title(按钮方案)、actionURL(点击按钮触发的URL)
     * @param int $btnOrientation 0-按钮竖直排列，1-按钮横向排列
     * @param int $hideAvatar 0-正常发消息者头像，1-隐藏发消息者头像
     *
     * @return void
     *
     */
    public function sendActionCard($title, $text, $btns = [], $btnOrientation = 0, $hideAvatar = 0)
    {
        $data = [
            'msgtype'    => 'actionCard',
            'actionCard' => [
                'title'          => $title,
                'text'           => $text,
                'btnOrientation' => $btnOrientation,
                'hideAvatar'     => $hideAvatar,
            ]
        ];
        if(count($btns) === 1){
            $btn = $btns[0];
            $data['actionCard']['singleTitle'] = $btn['title'];
            $data['actionCard']['singleURL'] = $btn['actionURL'];
        }else{
            $data['actionCard']['btns'] = $btns;
        }
        $this->send($data);
    }

    /**
     * 发送FeedCard
     * @param array $links 链接，每个元素包含 title(单条信息文本)、messageURL(点击单条信息到跳转链接)、picURL(单条信息后面图片的URL)
     *
     * @return void
     *
     */
    public function sendFeedCard($links = [])
    {
        $data = [
            'msgtype'  => 'feedCard',
            'feedCard' => [
                'links' => $links
            ]
        ];
        $this->send($data);
    }
}
