<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
        version="2.0"
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
        xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

    <xsl:output method="html" indent="yes" encoding="UTF-8"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>
                    Sitemap
                    <xsl:if test="sitemap:sitemapindex">Index</xsl:if>
                </title>
                <style type="text/css">
                    body {
                        font-family: sans-serif;
                    }
                    .count {
                        width: 60px;
                        text-align: center;
                        vertical-align: top;
                    }

                    .url {
                        text-align: left;
                    }

                    .modified {
                         width: 200px;
                         text-align: left;
                         vertical-align: top;
                    }
                </style>
            </head>
            <body>
                <header>
                    <div>
                        <h1>Sitemap</h1>
                    </div>
                    <h2>
                        This index contains
                        <xsl:value-of select="count(sitemap:urlset/sitemap:url)"/>
                        URLs.
                    </h2>
                    <p>
                        XML Sitemap for search engines such as <a href="https://www.google.com">Google</a>, <a href="https://www.bing.com/">Bing</a>, <a href="https://www.baidu.com/">Baidu</a>, and <a
                        href="https://yandex.com/">Yandex</a>.
                    </p>
                </header>

                <xsl:apply-templates/>

                <!-- This XML sitemap stylesheet is based on a GitHub stylesheet by Pedro Borges at https://github.com/pedroborges/xml-sitemap-stylesheet.

                Copyright (c) 2018 Rich DeBourke                
                Copyright (c) 2017 Pedro Borges

                Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

                The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

                THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. -->

            </body>
        </html>
    </xsl:template>

    <xsl:template match="sitemap:urlset">
        <div>
            <div>
                <table cellspacing="0">
                    <thead>
                        <tr>
                            <th class="count">#</th>
                            <th class="url">URL</th>
                            <xsl:if test="sitemap:url/sitemap:lastmod">
                            <th class="modified">Last Modified</th>
                            </xsl:if>
                        </tr>
                    </thead>
                    <tbody>
                    <xsl:for-each select="sitemap:url">
                        <tr>
                            <xsl:variable name="loc">
                                <xsl:value-of select="sitemap:loc"/>
                            </xsl:variable>
                            <xsl:variable name="pno">
                                <xsl:value-of select="position()"/>
                            </xsl:variable>
                            <td class="count">
                                <p>
                                    <xsl:value-of select="$pno"/>
                                </p>
                            </td>
                            <td class="url">
                                <p>
                                    <a href="{$loc}">
                                        <xsl:value-of select="sitemap:loc"/>
                                    </a>
                                </p>
                                <xsl:apply-templates select="xhtml:*"/>
                            </td>
                            <xsl:if test="sitemap:lastmod">
                            <td class="modified">
                                <p>
                                    <xsl:value-of select="concat(substring(sitemap:lastmod, 0, 11), concat(' ', substring(sitemap:lastmod, 12, 5)), concat(' ', substring(sitemap:lastmod, 20, 6)))"/>
                                </p>
                            </td>
                            </xsl:if>
                        </tr>
                    </xsl:for-each>
                    </tbody>
                </table>
            </div>
        </div>
    </xsl:template>

    <xsl:template match="xhtml:link">
        <xsl:variable name="altloc">
            <xsl:value-of select="@href"/>
        </xsl:variable>
        <p>
            Alt language version: 
            <a href="{$altloc}">
                <xsl:value-of select="@href"/> 
            </a> 
             – 
            <xsl:if test="@hreflang">
                <xsl:value-of select="@hreflang"/> 
            </xsl:if> 
        </p>
    </xsl:template>

</xsl:stylesheet>
