---
layout: posts
permalink: blog/
---

<div class="row">
<div class="col-md-8">

{% for post in site.posts %}   
{{ post.excerpt }}

<div class="col-md-3" style="padding-left:0;padding-top:8px"><a href="{{ post.url }}" class="btn btn-info"  role="button">Read More</a> </div>
{% endfor %}

</div>
<div class="col-md-4">
<div class="well">
<h4>Recent Posts</h4>
 {% for post in site.posts %}
 <ul><li><a href="{{ post.url }}">{{post.title}}  </a> </li></ul>
 {% endfor %}
 </div>
</div>
</div>

