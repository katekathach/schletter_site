---
title: Blog
layout: page
permalink: blog.html
description: Schletter Stories , News
---

<div class="row">

<div class="col-md-8">

{% for post in site.posts reverse  %} 
<h3 style="text-transform: uppercase;">{{post.title}} </h3>
<p>Posted By: {{post.author}} on {{ post.date | date: '%B %d, %Y' }}</p>
<section class="row" style="padding-bottom:9px">
<div class="col-md-12">Share this on &rarr;
<a href="https://twitter.com/intent/tweet?text={{ post.title }}&url={{ site.url }}{{ post.url }}&via={{ site.twitter_username }}&related={{ site.twitter_username }}" rel="nofollow" target="_blank" title="Share on Twitter"><img src="{{site.url}}/images/social/twitter.svg" alt="twitter" height="20" /></a>
<a href="https://facebook.com/sharer.php?u={{ site.url }}{{ post.url }}" rel="nofollow" target="_blank" title="Share on Facebook"><img src="{{site.url}}/images/social/facebook.svg" alt="facebook" height="20" /></a>
<a href="https://plus.google.com/share?url={{ site.url }}{{ post.url }}" rel="nofollow" target="_blank" title="Share on Google+"><img src="{{site.url}}/images/social/googleplus.svg" alt="google plus" height="20" /></a>
</div>
</section>


<p>{{ post.excerpt }}</p>
<a href="{{ post.url | prepend: site.baseurl }}" class="btn" style="background-color:#06805C; color:#fff;" role="button">Read More</a>

{% endfor %}

</div>


<div class="col-md-4">
<div class="well">
<h4>Recent Posts</h4>
 {% for post in site.posts %}
 <ul><li><a href="{{ post.url | prepend: site.baseurl }}">{{post.title}}</a></li></ul>
 {% endfor %}
 <a href="https://mailchi.mp/schletter/subscribe-to-schletter-blog" class="btn" target="_blank" style="background-color:#06805C; color:#fff;" role="button">Subscribe</a>
 </div>
</div>

</div>



