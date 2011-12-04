import re

from django.db import models


section_name_pattern = re.compile(r"^[a-z0-9\-]+$")

class Section(models.Model):
	name = models.CharField(max_length=60, unique=True, db_index=True)
	
	class Meta:
		ordering = ("name",)

	def __unicode__(self):
		return u"%s" % self.name

	def save(self, *args, **kwargs):
		if section_name_pattern.search(self.name):
			#save
			super(Section, self).save(*args, **kwargs)

class Article(models.Model):
	section         = models.ForeignKey(Section, null=True)
	slug            = models.CharField(max_length=252, db_index=True, unique=True)
	title           = models.CharField(max_length=252)
	sub_content     = models.CharField(max_length=124, db_index=True, blank=True)
	project_type_id = models.CharField(max_length=4, db_index=True)
	gen_content_id  = models.CharField(max_length=16, db_index=True)
	language        = models.CharField(max_length=2, blank=True)

	class Meta:
		ordering = ("project_type_id", "gen_content_id")
		unique_together = (("project_type_id", "gen_content_id"),)

	def __unicode__(self):
		return u"%s/%s: %s" % (self.project_type_id, self.gen_content_id, self.title)

	def get_absolute_url(self):
		return "/%s/%s/" % ((self.section is None and "encyclopedia" or self.section.name), self.slug)
