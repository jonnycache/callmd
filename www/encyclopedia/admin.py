from django.contrib import admin
from www.encyclopedia.models import Section, Article

admin.site.register(Section)

class ArticleAdmin(admin.ModelAdmin):
	fieldsets = (
		(None, {
			"fields": ("title", "slug", "section"),
		}),
		("More properties", {
			"classes": ("collapse",),
			"fields":  ("sub_content", "project_type_id", "gen_content_id", "language"),
		})
	)

	list_display = ("title", "section", "sub_content", "project", "content", "lang")
	list_editable = ("section",)
	list_filter = ("section", "sub_content", "project_type_id", "language")
	search_fields = ("title",)
	actions = None

	def project(self, obj):
		return obj.project_type_id
	project.short_description = "P"

	def content(self, obj):
		return obj.gen_content_id
	content.short_description = "C"

	def lang(self, obj):
		return obj.language

admin.site.register(Article, ArticleAdmin)
