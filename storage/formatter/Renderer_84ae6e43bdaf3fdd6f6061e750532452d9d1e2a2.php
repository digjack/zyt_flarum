<?php

/**
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2016 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
class Renderer_84ae6e43bdaf3fdd6f6061e750532452d9d1e2a2 extends \s9e\TextFormatter\Renderer
{
	protected $params=array('DISCUSSION_URL'=>'','PROFILE_URL'=>'');
	protected static $tagBranches=array('C'=>0,'CODE'=>1,'DEL'=>2,'EM'=>3,'EMAIL'=>4,'EMOJI'=>5,'ESC'=>6,'H1'=>7,'H2'=>8,'H3'=>9,'H4'=>10,'H5'=>11,'H6'=>12,'HR'=>13,'IMG'=>14,'LI'=>15,'LIST'=>16,'POSTMENTION'=>17,'QUOTE'=>18,'STRONG'=>19,'SUP'=>20,'URL'=>21,'USERMENTION'=>22,'br'=>23,'e'=>24,'i'=>24,'s'=>24,'p'=>25);
	public function __sleep()
	{
		$props = get_object_vars($this);
		unset($props['out'], $props['proc'], $props['source']);
		return array_keys($props);
	}
	public function renderRichText($xml)
	{
		if (!isset($this->quickRenderingTest) || !preg_match($this->quickRenderingTest, $xml))
			try
			{
				return $this->renderQuick($xml);
			}
			catch (\Exception $e)
			{
			}
		$dom = $this->loadXML($xml);
		$this->out = '';
		$this->at($dom->documentElement);
		return $this->out;
	}
	protected function at(\DOMNode $root)
	{
		if ($root->nodeType === 3)
			$this->out .= htmlspecialchars($root->textContent,0);
		else
			foreach ($root->childNodes as $node)
				if (!isset(self::$tagBranches[$node->nodeName]))
					$this->at($node);
				else
				{
					$tb = self::$tagBranches[$node->nodeName];
					if($tb<13)if($tb<7)if($tb<4)if($tb===0){$this->out.='<code>';$this->at($node);$this->out.='</code>';}elseif($tb===1){$this->out.='<pre><code';if($node->hasAttribute('lang'))$this->out.=' class="language-'.htmlspecialchars($node->getAttribute('lang'),2).'"';$this->out.='>';$this->at($node);$this->out.='</code></pre>';}elseif($tb===2){$this->out.='<del>';$this->at($node);$this->out.='</del>';}else{$this->out.='<em>';$this->at($node);$this->out.='</em>';}elseif($tb===4){$this->out.='<a href="mailto:'.htmlspecialchars($node->getAttribute('email'),2).'">';$this->at($node);$this->out.='</a>';}elseif($tb===5){$this->out.='<img alt="'.htmlspecialchars($node->textContent,2).'" class="emoji" draggable="false" src="//cdn.jsdelivr.net/emojione/assets/png/';if((strpos($node->getAttribute('seq'),'-20e3')!==false)||$node->getAttribute('seq')==='a9'||$node->getAttribute('seq')==='ae')$this->out.='00';$this->out.=htmlspecialchars($node->getAttribute('seq'),2).'.png">';}else$this->at($node);elseif($tb<10)if($tb===7){$this->out.='<h1>';$this->at($node);$this->out.='</h1>';}elseif($tb===8){$this->out.='<h2>';$this->at($node);$this->out.='</h2>';}else{$this->out.='<h3>';$this->at($node);$this->out.='</h3>';}elseif($tb===10){$this->out.='<h4>';$this->at($node);$this->out.='</h4>';}elseif($tb===11){$this->out.='<h5>';$this->at($node);$this->out.='</h5>';}else{$this->out.='<h6>';$this->at($node);$this->out.='</h6>';}elseif($tb<20)if($tb<17){if($tb===13)$this->out.='<hr>';elseif($tb===14){$this->out.='<img src="'.htmlspecialchars($node->getAttribute('src'),2).'"';if($node->hasAttribute('alt'))$this->out.=' alt="'.htmlspecialchars($node->getAttribute('alt'),2).'"';if($node->hasAttribute('title'))$this->out.=' title="'.htmlspecialchars($node->getAttribute('title'),2).'"';$this->out.='>';}elseif($tb===15){$this->out.='<li>';$this->at($node);$this->out.='</li>';}elseif(!$node->hasAttribute('type')){$this->out.='<ul>';$this->at($node);$this->out.='</ul>';}else{$this->out.='<ol';if($node->hasAttribute('start'))$this->out.=' start="'.htmlspecialchars($node->getAttribute('start'),2).'"';$this->out.='>';$this->at($node);$this->out.='</ol>';}}elseif($tb===17)$this->out.='<a href="'.htmlspecialchars($this->params['DISCUSSION_URL'].$node->getAttribute('discussionid'),2).'/'.htmlspecialchars($node->getAttribute('number'),2).'" class="PostMention" data-id="'.htmlspecialchars($node->getAttribute('id'),2).'">'.htmlspecialchars($node->getAttribute('username'),0).'</a>';elseif($tb===18){$this->out.='<blockquote>';$this->at($node);$this->out.='</blockquote>';}else{$this->out.='<strong>';$this->at($node);$this->out.='</strong>';}elseif($tb<23)if($tb===20){$this->out.='<sup>';$this->at($node);$this->out.='</sup>';}elseif($tb===21){$this->out.='<a href="'.htmlspecialchars($node->getAttribute('url'),2).'" target="_blank" rel="nofollow noreferrer">';$this->at($node);$this->out.='</a>';}else$this->out.='<a href="'.htmlspecialchars($this->params['PROFILE_URL'].$node->getAttribute('username'),2).'" class="UserMention">@'.htmlspecialchars($node->getAttribute('username'),0).'</a>';elseif($tb===23)$this->out.='<br>';elseif($tb===24);else{$this->out.='<p>';$this->at($node);$this->out.='</p>';}
				}
	}
	private static $static=array('/C'=>'</code>','/CODE'=>'</code></pre>','/DEL'=>'</del>','/EM'=>'</em>','/EMAIL'=>'</a>','/ESC'=>'','/H1'=>'</h1>','/H2'=>'</h2>','/H3'=>'</h3>','/H4'=>'</h4>','/H5'=>'</h5>','/H6'=>'</h6>','/LI'=>'</li>','/QUOTE'=>'</blockquote>','/STRONG'=>'</strong>','/SUP'=>'</sup>','/URL'=>'</a>','C'=>'<code>','DEL'=>'<del>','EM'=>'<em>','ESC'=>'','H1'=>'<h1>','H2'=>'<h2>','H3'=>'<h3>','H4'=>'<h4>','H5'=>'<h5>','H6'=>'<h6>','HR'=>'<hr>','LI'=>'<li>','QUOTE'=>'<blockquote>','STRONG'=>'<strong>','SUP'=>'<sup>');
	private static $dynamic=array('EMAIL'=>array('(^[^ ]+(?> (?!email=)[^=]+="[^"]*")*(?> email="([^"]*)")?.*)s','<a href="mailto:$1">'),'IMG'=>array('(^[^ ]+(?> (?!(?>alt|src|title)=)[^=]+="[^"]*")*( alt="[^"]*")?(?> (?!(?>src|title)=)[^=]+="[^"]*")*(?> src="([^"]*)")?(?> (?!title=)[^=]+="[^"]*")*( title="[^"]*")?.*)s','<img src="$2"$1$3>'),'URL'=>array('(^[^ ]+(?> (?!url=)[^=]+="[^"]*")*(?> url="([^"]*)")?.*)s','<a href="$1" target="_blank" rel="nofollow noreferrer">'));
	private static $attributes;
	private static $quickBranches=array('/LIST'=>0,'CODE'=>1,'EMOJI'=>2,'LIST'=>3,'POSTMENTION'=>4,'USERMENTION'=>5);

	protected function renderQuick($xml)
	{
		$xml = $this->decodeSMP($xml);
		self::$attributes = array();
		$html = preg_replace_callback(
			'(<(?:(?!/)((?>EMOJI|HR|IMG|(?>POST|USER)MENTION))(?: [^>]*)?>.*?</\\1|(/?(?!br/|p>)[^ />]+)[^>]*?(/)?)>)s',
			array($this, 'quick'),
			preg_replace(
				'(<[eis]>[^<]*</[eis]>)',
				'',
				substr($xml, 1 + strpos($xml, '>'), -4)
			)
		);

		return str_replace('<br/>', '<br>', $html);
	}

	protected function quick($m)
	{
		if (isset($m[2]))
		{
			$id = $m[2];

			if (isset($m[3]))
			{
				unset($m[3]);

				$m[0] = substr($m[0], 0, -2) . '>';
				$html = $this->quick($m);

				$m[0] = '</' . $id . '>';
				$m[2] = '/' . $id;
				$html .= $this->quick($m);

				return $html;
			}
		}
		else
		{
			$id = $m[1];

			$lpos = 1 + strpos($m[0], '>');
			$rpos = strrpos($m[0], '<');
			$textContent = substr($m[0], $lpos, $rpos - $lpos);

			if (strpos($textContent, '<') !== false)
				throw new \RuntimeException;

			$textContent = htmlspecialchars_decode($textContent);
		}

		if (isset(self::$static[$id]))
			return self::$static[$id];

		if (isset(self::$dynamic[$id]))
		{
			list($match, $replace) = self::$dynamic[$id];
			return preg_replace($match, $replace, $m[0], 1);
		}

		if (!isset(self::$quickBranches[$id]))
		{
			if ($id[0] === '!' || $id[0] === '?')
				throw new \RuntimeException;
			return '';
		}

		$attributes = array();
		if (strpos($m[0], '="') !== false)
		{
			preg_match_all('(([^ =]++)="([^"]*))S', substr($m[0], 0, strpos($m[0], '>')), $matches);
			foreach ($matches[1] as $i => $attrName)
				$attributes[$attrName] = $matches[2][$i];
		}

		$qb = self::$quickBranches[$id];
		if($qb<3){if($qb===0){$attributes=array_pop(self::$attributes);$html='';if(!isset($attributes['type']))$html.='</ul>';else$html.='</ol>';}elseif($qb===1){$html='<pre><code';if(isset($attributes['lang']))$html.=' class="language-'.$attributes['lang'].'"';$html.='>';}else{$attributes+=array('seq'=>null);$html='<img alt="'.htmlspecialchars($textContent,2).'" class="emoji" draggable="false" src="//cdn.jsdelivr.net/emojione/assets/png/';if((strpos($attributes['seq'],'-20e3')!==false)||$attributes['seq']==='a9'||$attributes['seq']==='ae')$html.='00';$html.=$attributes['seq'].'.png">';}}elseif($qb===3){$html='';if(!isset($attributes['type']))$html.='<ul>';else{$html.='<ol';if(isset($attributes['start']))$html.=' start="'.$attributes['start'].'"';$html.='>';}self::$attributes[]=$attributes;}elseif($qb===4){$attributes+=array('discussionid'=>null,'number'=>null,'id'=>null,'username'=>null);$html='<a href="'.htmlspecialchars($this->params['DISCUSSION_URL'].htmlspecialchars_decode($attributes['discussionid']),2).'/'.$attributes['number'].'" class="PostMention" data-id="'.$attributes['id'].'">'.str_replace('&quot;','"',$attributes['username']).'</a>';}else{$attributes+=array('username'=>null);$html='<a href="'.htmlspecialchars($this->params['PROFILE_URL'].htmlspecialchars_decode($attributes['username']),2).'" class="UserMention">@'.str_replace('&quot;','"',$attributes['username']).'</a>';}

		return $html;
	}
}