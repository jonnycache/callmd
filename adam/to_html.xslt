<xsl:stylesheet version = '1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>
	<!-- main loop -->
	<xsl:template match="/adamContent">
		<div class="ADAM">
			<div class="bar">
				<h3>Navigation</h3>
				<ul>
					<li><a href="/encyclopedia/home/">Encyclopedia home</a></li>
					<li>
						<xsl:choose>
							<xsl:when test="@subContent = ''">
								<a href="/encyclopedia/index/">Encyclopedia A-Z</a>
							</xsl:when>
							<xsl:otherwise>
								<a>
									<xsl:attribute name="href">
										<xsl:value-of select="concat('/encyclopedia/index/?content=', @subContent)" />
									</xsl:attribute>
									<xsl:value-of select="concat(@subContent, ' A-Z')" />
								</a>
							</xsl:otherwise>
						</xsl:choose>
					</li>
				</ul>
				<xsl:apply-templates select="textContent" mode="bar" />
				<xsl:apply-templates select="relatedItems" mode="bar" />
			</div>
			<h1><xsl:value-of select="@title" /></h1>
			<xsl:apply-templates select="textContent" />
			<hr class="main-separator" />
			<xsl:apply-templates select="versionInfo" />
		</div>
	</xsl:template>
	<!-- main content -->
	<xsl:template match="textContent">
		<xsl:if test="@title != 'visHeader' and count(descendant-or-self::text()) &gt; 0">
			<xsl:choose>
				<xsl:when test="count(visualContent) &gt; 0">
					<xsl:if test="@title != ''">
						<h2><xsl:value-of select="@title" /></h2>
					</xsl:if>
					<div class="visualContent">
						<xsl:choose>
							<xsl:when test="visualContent/@mediaType = 'gif' and visualContent/@graphicType = 'rollover_globals'">
								<p>
									<xsl:attribute name="class">
										<xsl:value-of select="videolink" />
									</xsl:attribute>
									<xsl:text>Watch video on </xsl:text>
									<xsl:value-of select="@alt" />
									<xsl:text>:</xsl:text>
									<br/>
									<a>
										<xsl:attribute name="href">
											<xsl:value-of select="concat('/encyclopedia/', visualContent/visualLink/@projectTypeID, '/', visualContent/visualLink/@genContentID)" />
										</xsl:attribute>
										<img>
											<xsl:attribute name="src">
												<xsl:value-of select="concat('/media/ADAM/graphics/images/tnail/', visualContent/@genContentID, 't.', visualContent/@mediaType)" />
											</xsl:attribute>
											<xsl:attribute name="alt">
												<xsl:value-of select="@alt" />
											</xsl:attribute>
											<xsl:attribute name="title">
												<xsl:value-of select="@alt" />
											</xsl:attribute>
											<xsl:attribute name="class">
												<xsl:value-of select="rollover" />
											</xsl:attribute>
											<xsl:attribute name="onmouseover">
												<xsl:value-of select="rollover" />
											</xsl:attribute>
											<xsl:attribute name="onmouseout">
												<xsl:value-of select="rollout" />
											</xsl:attribute>
										</img>
									</a>
								</p>
							</xsl:when>
							<xsl:when test="visualContent/@mediaType = 'jpg' or visualContent/@mediaType = 'gif'">
								<img>
									<xsl:attribute name="src">
										<xsl:value-of select="concat('/media/ADAM/graphics/images/en/', visualContent/@genContentID, '.', visualContent/@mediaType)" />
									</xsl:attribute>
									<xsl:attribute name="alt">
										<xsl:value-of select="@alt" />
									</xsl:attribute>
									<xsl:attribute name="title">
										<xsl:value-of select="@alt" />
									</xsl:attribute>
								</img>
							</xsl:when>
							<xsl:when test="visualContent/@mediaType = 'flv'">
								<style>.ADAM .bar { display: none !important; }</style>
								<div id="containerx">
									<embed width="454" height="260" allowscriptaccess="always" allowfullscreen="true" quality="high" name="mediaplayer" id="mediaplayer" src="http://default.adam.com/graphics/global/mediaplayer_vidhd.swf" type="application/x-shockwave-flash">
										<xsl:attribute name="flashvars">
											<xsl:value-of select="concat('width=454&amp;height=253&amp;bufferlength=3&amp;file=rtmp://default.adam.com/vod2/Multimedia&amp;id=en/', visualContent/@genContentID, '/', visualContent/@genContentID, '&amp;image=http://default.adam.com/graphics/Multimedia/en/', visualContent/@genContentID, '/', visualContent/@genContentID, 'ed.jpg&amp;smoothing=true&amp;hdlink=', visualContent/@genContentID)" />
										</xsl:attribute>
									</embed>
									<a href="http://default.adam.com/graphics/global/mediaplayer_vidhd.swf" class="vlnxgqlmkrfbgjupthtj"><xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text></a>
									<a href="http://default.adam.com/graphics/global/mediaplayer_vidhd.swf" class="vlnxgqlmkrfbgjupthtj"><xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text></a>
								</div>
								<script type="text/javascript">
									s1 = new SWFObject("http://default.adam.com/graphics/global/mediaplayer_vidhd.swf","mediaplayer","454","260","8");  
									s1.addParam("allowfullscreen","true");
									s1.addParam("AllowScriptAccess","always");
									s1.addVariable("width","454"); 
									s1.addVariable("height","253");
									s1.addVariable("bufferlength","3");
									s1.addVariable('file', 'rtmp://default.adam.com/vod2/Multimedia');
									s1.addVariable("smoothing","true");
								</script>
								<script>
									<xsl:text>s1.addVariable("image","http://default.adam.com/graphics/Multimedia/en/</xsl:text>
									<xsl:value-of select="concat(visualContent/@genContentID, '/', visualContent/@genContentID)" />
									<xsl:text>ed.jpg");</xsl:text>
									<xsl:text>s1.addVariable('id', 'en/</xsl:text>
									<xsl:value-of select="concat(visualContent/@genContentID, '/', visualContent/@genContentID)" />
									<xsl:text>');s1.addVariable('hdlink','</xsl:text>
									<xsl:value-of select="visualContent/@genContentID" />
									<xsl:text>');s1.write('containerx');</xsl:text>
								</script>
							</xsl:when>
							<xsl:when test="visualContent/@mediaType = 'dcr'">
								<object classid="clsid:166B1BCA-3F9C-11CF-8075-444553540000" codebase="http://active.macromedia.com/director/cabs/sw.cab#version=7,0,2,0" height="340" width="400">
									<param name="src">
										<xsl:attribute name="value">
											<xsl:value-of select="concat('/media/ADAM/graphics/multimedia/en/', visualContent/@genContentID, '/', visualContent/@genContentID, '.dcr')"/>
										</xsl:attribute>
									</param>
									<param name="autoplay" value="true" />
									<param name="controller" value="true" />
									<xsl:text disable-output-escaping="yes">&lt;!--[if !IE]&gt;</xsl:text>
									<object type="application/x-director" height="340" width="400">
										<xsl:attribute name="data">
											<xsl:value-of select="concat('/media/ADAM/graphics/multimedia/en/', visualContent/@genContentID, '/', visualContent/@genContentID, '.dcr')"/>
										</xsl:attribute>
										<param name="autoplay" value="true" />
										<param name="controller" value="true" />
									</object>
									<a class="zsdlgaeoplihdsvzyvks">
										<xsl:attribute name="href">
											<xsl:value-of select="concat('/media/ADAM/graphics/multimedia/en/', visualContent/@genContentID, '/', visualContent/@genContentID, '.dcr')"/>
										</xsl:attribute>
										<xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text>
									</a>
									<xsl:text disable-output-escaping="yes">&lt;![endif]--&gt;</xsl:text>
								</object>
							</xsl:when>
						</xsl:choose>
						<hr />
						<xsl:apply-templates />
					</div>
				</xsl:when>
				<xsl:otherwise>
					<h2><xsl:value-of select="@title" /></h2>
					<xsl:apply-templates />
				</xsl:otherwise>
			</xsl:choose>
		</xsl:if>
	</xsl:template>
	<xsl:template match="textLink">
		<a>
			<xsl:attribute name="href">
				<xsl:value-of select="concat('/encyclopedia/', @projectTypeID, '/', @genContentID)" />
			</xsl:attribute>
			<xsl:value-of select="." />
		</a>
	</xsl:template>
	<xsl:template match="versionInfo">
		<div class="versionInfo">
			<div class="reviewDate">
				<span class="prompt">Review date: </span>
				<span class="value"><xsl:value-of select="@reviewDate" /></span>
			</div>
			<div class="reviewedBy">
				<span class="prompt">Reviewed by: </span>
				<span class="value"><xsl:value-of select="@reviewedBy" /></span>
			</div>
		</div>
	</xsl:template>
	<!-- side bar -->
	<xsl:template match="textContent" mode="bar">
		<xsl:if test="@title = 'visHeader'">
			<xsl:if test="count(visualContent) &gt; 0">
				<h3>Images</h3>
				<xsl:apply-templates mode="bar" />
			</xsl:if>
		</xsl:if>
	</xsl:template>
	<xsl:template match="visualContent" mode="bar">
		<xsl:variable name="title">
			<xsl:choose>
				<xsl:when test="@alt = ''">
					<xsl:value-of select=".//text()" />
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="@alt" />
				</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		<div class="visualContent">
			<div class="thumbnail">
				<a>
					<xsl:attribute name="href">
						<xsl:value-of select="concat('/encyclopedia/', visualLink/@projectTypeID, '/', visualLink/@genContentID)" />
					</xsl:attribute>
					<img>
						<xsl:attribute name="src">
							<xsl:value-of select="concat('/media/ADAM/graphics/tnail/', @genContentID, 't.', @mediaType)" />
						</xsl:attribute>
						<xsl:attribute name="alt">
							<xsl:value-of select="$title" />
						</xsl:attribute>
						<xsl:attribute name="title">
							<xsl:value-of select="$title" />
						</xsl:attribute>
					</img>
				</a>
			</div>
			<div class="label">
				<a>
					<xsl:attribute name="href">
						<xsl:value-of select="concat('/encyclopedia/', visualLink/@projectTypeID, '/', visualLink/@genContentID)" />
					</xsl:attribute>
					<span><xsl:value-of select="$title" /></span>
				</a>
			</div>
		</div>
	</xsl:template>
	<xsl:template match="relatedItems" mode="bar">
		<xsl:if test="count(item) &gt; 0">
			<div>
				<xsl:attribute name="class">
					<xsl:value-of select="@type" />
				</xsl:attribute>
				<h3 class="type-carePoints">Care Points</h3>
				<h3 class="type-readMore">Read More</h3>
				<ul>
					<xsl:apply-templates select="item" mode="bar" />
				</ul>
			</div>
		</xsl:if>
	</xsl:template>
	<xsl:template match="item" mode="bar">
		<li>
			<a>
				<xsl:attribute name="href">
					<xsl:value-of select="concat('/encyclopedia/', @projectTypeID, '/', @genContentID)" />
				</xsl:attribute>
				<span><xsl:value-of select="@Title" /></span>
			</a>
		</li>
	</xsl:template>
	<!-- supress these nodes -->
	<xsl:template match="visualContent">
	</xsl:template>
	<xsl:template match="relatedItems">
	</xsl:template>
	<!-- copy the rest -->
	<xsl:template match="*">
		<xsl:copy>
			<xsl:apply-templates />
		</xsl:copy>
	</xsl:template>
</xsl:stylesheet>
