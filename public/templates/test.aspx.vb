Imports DocumentFormat.OpenXml
Imports DocumentFormat.OpenXml.Packaging
Imports DocumentFormat.OpenXml.Wordprocessing

Partial Class Secured_Templates_test
    Inherits System.Web.UI.Page
    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load


        Dim strBody As New System.Text.StringBuilder("")

        strBody.Append("<html " & _
                "xmlns:o='urn:schemas-microsoft-com:office:office' " & _
                "xmlns:w='urn:schemas-microsoft-com:office:word'" & _
                "xmlns='http://www.w3.org/TR/REC-html40'>" & _
                "<head>")

        'The setting specifies document's view after it is downloaded as Print
        'instead of the default Web Layout
        strBody.Append("<!--[if gte mso 10]>" & _
                                 "<xml>" & _
                                 "<w:WordDocument>" & _
                                 "<w:View>Print</w:View>" & _
                                 "<w:Zoom>90</w:Zoom>" & _
                                 "<w:DoNotOptimizeForBrowser/>" & _
                                 "</w:WordDocument>" & _
                                 "</xml>" & _
                                 "<![endif]-->")

        strBody.Append("<style>" & _
                                "<!-- /* Style Definitions */" & _
                                "@page Section1" & _
                                "   {vertical-align:top; size:11.0in 8.5in; " & _
                                "   margin:1in 1in  1in 1in ; " & _
                                "   mso-header-margin:1in; " & _
                                "   mso-footer-margin:1in; mso-paper-source:0;}" & _
                                " div.Section1" & _
                                "   {page:Section1;}" & _
                                "-->" & _
                               "</style></head>")
        Dim sw As StringWriter = New StringWriter()
        Dim htw As HtmlTextWriter = New HtmlTextWriter(sw)
        Panel1.RenderControl(htw)
        strBody.Append(sw)


        Response.AppendHeader("Content-Type", "application/msword")
        Response.AppendHeader("Content-disposition", _
                               "attachment; filename=myword.doc")

        Response.Write(strBody)
        Response.End()

    End Sub
    Private Sub HelloWorld()

    End Sub
End Class
