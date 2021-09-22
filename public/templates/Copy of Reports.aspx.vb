Imports iTextSharp.text
Imports iTextSharp.text.pdf
Imports iTextSharp.text.html.simpleparser
Imports iTextSharp.text.html

Partial Class Secured_Templates_SwornStatement
    Inherits System.Web.UI.Page
    Public Overrides Sub VerifyRenderingInServerForm(ByVal con As Control)

    End Sub


    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load

        If Request.QueryString("GUID") Is Nothing Then

            Dim f As FileInfo = New FileInfo(Server.MapPath("~/Secured/Templates/" + Request.QueryString("Template").ToString))
            DownLoadFile(f)

        Else
            Dim p As New Project
            p = p.GetProject(Request.QueryString("GUID").ToString)

            Select Case Request.QueryString("Type").ToString
                Case "Sworn"
                    GenerateSworn(p)
                Case "Basic"
                    GenerateBasic(p)
                Case "Order"
                    GenerateOrder(p)
                Case "PEMAPS"
                    Dim f As FileInfo = New FileInfo(Server.MapPath("~/Secured/Templates/PEMAPS.pdf"))
                    DownLoadFile(f)

            End Select

        End If

    End Sub
    Private Sub DownLoadFile(ByVal f As FileInfo)
        Context.Response.ContentType = "application/pdf"
        Context.Response.AddHeader("Content-Length", f.Length.ToString())
        Context.Response.WriteFile(f.FullName)
        Context.Response.Flush()
        Context.ApplicationInstance.CompleteRequest()
    End Sub
    Private Sub GenerateSworn(ByVal p As Project)
        Dim t As New Table
        t.Font.Size = 10
        t.Width = Unit.Percentage(100)


        Dim r As New TableRow
        Dim c As New TableCell
        c.HorizontalAlign = HorizontalAlign.Justify

        Dim prop As New Proponent
        prop = prop.GetProponent(p.ProponentGUID.ToString)
        c.Text = "<p style='text-align:center;'><b>SWORN STATEMENT OF ACCOUNTABILITY OF THE PROPONENT</b></p><br/><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that all the information and commitments in this Initial Environmental Examination (IEE) Checklist Report are accurate and complete to the best of my knowledge.</p>" & _
            "<br/><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By the authority vested in me by the <u><b>" + prop.ProponentName.ToString + "</b></u> as <u><b>" + p.Designation.ToString + "</b></u>. I hereby commit to ensure implementation of  all commitments, mitigating measures and monitoring requirements indicated in this IEE Checklist Report as well as the following:</p>" & _
            "<p style='padding-left:50px;'>1. Conform to pertinent provisions of applicable environmental laws e.g., R.A. No. 6969 (Toxic Substances and Hazardous and Nuclear Wastes Control Act of 1990), R.A. No. 9003 (Ecological Solid Waste Management Act of 2000), R.A. No. 9275 (Philippine Clean Water Act of 2004), and R.A. No. 8749 (Philippine Clean Air Act of 1999).<br/>" & _
            "2. Abide and conform to LGU development plans and guidelines.<br/>" & _
            "3. Regularly submit reports to concerned agencies.</p><br/>" & _
            "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I hereby bind myself to answer any penalty that may be imposed arising from any misrepresentation or failure to state material information in this IEE Checklist.</p><br/>" & _
            "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In witness whereof, I hereby set my hand this ________ day of _______________  at __________________________.</p><br/><br/><br/>"
        r.Cells.Add(c)
        t.Rows.Add(r)

        Dim r1 As New TableRow
        Dim c1 As New TableCell
        c1.HorizontalAlign = HorizontalAlign.Center
        c1.Text = "<u><b>" + p.Representative.ToString + "</u></b><br/>" + p.Designation.ToString + "<br/>" + prop.ProponentName.ToString + "<br/><br/>"
        r1.Cells.Add(c1)
        t.Rows.Add(r1)


        Dim r4 As New TableRow
        Dim c4 As New TableCell
        c4.HorizontalAlign = HorizontalAlign.Justify
        c4.Text = "SUBSCRIBED AND SWORN TO before me this ________ day of _______________ 201___, affiant exhibiting his/her Community Tax Certificate No. __________________________ issued at ______________________ on __________________________.<br/><br/><br/><br/>"
        r4.Cells.Add(c4)
        t.Rows.Add(r4)

        Dim r5 As New TableRow
        Dim c5 As New TableCell
        c5.Text = "Doc. No.  _______________<br/>Page No. _______________<br/>Book No. _______________<br/>Series of _______________"
        r5.Cells.Add(c5)
        t.Rows.Add(r5)

        Panel1.Controls.Add(t)

        DownloadReport(Panel1, "SwornStatement")
    End Sub
    Private Sub GenerateBasic(ByVal p As Project)

        Dim v As New HtmlGenericControl
        v.InnerHtml = "PROJECT FACT SHEET<br/><br/>"
        v.Style.Add("padding", "50")
        v.Style.Add("font-weight", "bold")
        v.Style.Add("text-align", "center")

        Panel1.Controls.Add(v)

        Dim t As New Table
        t.CellSpacing = 0
        t.CellPadding = 5
        t.Font.Size = 10
        t.Width = Unit.Percentage(100)

        Dim pp As New Proponent
        pp = pp.GetProponent(p.ProponentGUID.ToString)


        For i As Integer = 1 To 5
            Dim r As New TableRow
            Dim c As New TableCell
            Dim c1 As New TableCell
            Dim c2 As New TableCell

            Select Case i
                Case 0
                    'c.Text = "PROJECT FACT SHEET<br/><br/>"
                    'c.Font.Bold = True
                    'c.Style.Add("border-bottom-style", "Solid")
                    'c.Font.Underline = True
                    'c.HorizontalAlign = 2
                    'c.ColumnSpan = 3
                    'r.Cells.Add(c)

                Case 1
                    c.Text = "<b>Name of the Project</b>"
                    c1.Text = p.ProjectName.ToString
                    c1.ColumnSpan = 2
                    r.Cells.Add(c)
                    r.Cells.Add(c1)

                Case 2
                    c.Text = "<b>Proponent Name</b>"
                    c1.Text = pp.ProponentName.ToString
                    c1.ColumnSpan = 2
                    r.Cells.Add(c)
                    r.Cells.Add(c1)

                Case 3
                    c.Text = "<b>Proponent Address</b>"
                    c1.Text = pp.MailingAddress.ToString
                    c1.ColumnSpan = 2
                    r.Cells.Add(c)
                    r.Cells.Add(c1)

                Case 4
                    c.Text = "<b>Authorized Representative</b>"
                    c.VerticalAlign = VerticalAlign.Top
                    c1.VerticalAlign = VerticalAlign.Top
                    c1.Text = "<b>Name<br/></b>" + p.Representative.ToString
                    c2.Text = "<b>Designation</b><br/>" + p.Designation.ToString
                    r.Cells.Add(c)
                    r.Cells.Add(c1)
                    r.Cells.Add(c2)

                Case 5
                    c.Text = "<b>Proponent Means of Contact</b>"
                    c.VerticalAlign = VerticalAlign.Top
                    c.RowSpan = 2
                    c1.Text = "<b>Landline No.</b><br/>" + p.LandlineNo.ToString
                    c2.Text = "<b>Fax No.<br/></b>" + p.FaxNo.ToString
                    r.Cells.Add(c)
                    r.Cells.Add(c1)
                    r.Cells.Add(c2)
                Case 6
                    c1.VerticalAlign = VerticalAlign.Top
                    c1.Text = "<b>Mobile No.</b><br/>" + p.MobileNo.ToString
                    c2.Text = "<b>Email Address</b><br/>" + p.EmailAddress.ToString
                    r.Cells.Add(c1)
                    r.Cells.Add(c2)

            End Select
            t.Rows.Add(r)
        Next

        Panel1.Controls.Add(t)


        'project description
        Dim v1 As New HtmlGenericControl
        v1.InnerHtml = "<br/>Project Description<br/><br/>"
        v1.Style.Add("font-weight", "bold")
        Panel1.Controls.Add(v1)


        Dim prjc As New ProjectCoverage
        prjc = prjc.GetProjectType(p.ComponentGUID.ToString)

        Dim t1 As New Table
        t1.CellSpacing = 0
        t1.CellPadding = 5
        t1.Font.Size = 10
        t1.Width = Unit.Percentage(100)

        For i As Integer = 1 To 3
            Dim r1 As New TableRow
            Dim c3 As New TableCell
            Dim c4 As New TableCell
            Dim c5 As New TableCell


            Select Case i
                Case 1
                    c3.Text = "Project Type"
                    c4.Text = "Project Size Parameter"
                    c5.Text = "Project Size"
                    r1.Font.Bold = True
                Case 2
                    c3.Text = prjc.ProjectType.ToString + "; " + prjc.ProjectSubType.ToString + "; " + prjc.ProjectSpecificType.ToString + "; " + prjc.ProjectSpecificSubType.ToString
                    c4.Text = prjc.Parameter.ToString
                    c5.Text = p.ProjectSize.ToString + " " + prjc.UnitOfMeasure.ToString
                Case 3
                    c3.Text = "<b>Other Description Details:</b><br/>" + p.Description.ToString
                    c3.ColumnSpan = 3
            End Select
            r1.Cells.Add(c3)
            r1.Cells.Add(c4)
            r1.Cells.Add(c5)
            t1.Rows.Add(r1)
        Next


        Panel1.Controls.Add(t1)


        '1.1 Project Location and Area
        Dim v2 As New HtmlGenericControl
        v2.InnerHtml = "<br/>1.1. PROJECT LOCATION AND AREA:<br/><br/>"
        v2.Style.Add("font-weight", "bold")
        Panel1.Controls.Add(v2)

        Dim t2 As New Table
        t2.CellSpacing = 0
        t2.CellPadding = 5
        t2.Font.Size = 10
        t2.Width = Unit.Percentage(100)
        For i As Integer = 1 To 3
            Dim r1 As New TableRow
            Dim c3 As New TableCell
            Dim c4 As New TableCell
            Dim c5 As New TableCell


            Select Case i
                Case 1
                    c3.Text = "Street/Sitio/Barangay:<br/>" + p.Address.ToString
                    c4.Text = "Zone/Classification (i.e. industrial, residential):<br/>" + p.ZoneClassification.ToString
                    c4.ColumnSpan = 2
                Case 2
                    c3.Text = "City/Municipality:<br/>" + p.Municipality.ToString
                    c4.Text = "Province:<br/>" + p.Province.ToString
                    c5.Text = "Region:<br/>" + Class1.GetRegion(p.Province.ToString)
                    r1.Cells.Add(c5)

                Case 3
                    c3.Text = "Total Project Land Area:<br/>" + p.LandAreaInSqM.ToString + " sq. m."
                    c4.Text = "Total Project/Building Footprint Area:<br/>" + p.FootPrintAreaInSqM.ToString + " sq. m."
                    c4.ColumnSpan = 2

            End Select
            r1.Cells.Add(c3)
            r1.Cells.Add(c4)
            t2.Rows.Add(r1)
        Next

        Panel1.Controls.Add(t2)



        'Geographic coordinates
        Dim v3 As New HtmlGenericControl
        v3.InnerHtml = "<br/>Geographic Coordinates of the Project Area (WGS84):<br/><br/>"
        v3.Style.Add("font-weight", "bold")
        Panel1.Controls.Add(v3)

        Dim t3 As New Table
        t3.CellSpacing = 0
        t3.CellPadding = 5
        t3.Font.Size = 10
        t3.Width = Unit.Percentage(100)

        For i As Integer = 1 To 1
            Dim r1 As New TableRow
            Dim c3 As New TableCell
            Dim c4 As New TableCell
            Dim c5 As New TableCell

            Select Case i
                Case 1
                    c3.Text = "Area"
                    c4.Text = "Longitude"
                    c5.Text = "Latitude"
            End Select
            r1.Cells.Add(c3)
            r1.Cells.Add(c4)
            r1.Cells.Add(c5)
            t3.Rows.Add(r1)
        Next

        Dim geo As New GeoCoordinate
        Dim ds As DataSet = geo.GetGeos(p.GUID.ToString)
        Dim ii As String = String.Empty

        For Each dr As DataRow In ds.Tables(0).Rows
            Dim r1 As New TableRow
            Dim c3 As New TableCell
            Dim c4 As New TableCell
            Dim c5 As New TableCell
            If ii.ToString = dr("Area").ToString Then
                c3.Text = String.Empty
            Else
                c3.Text = dr("Area").ToString
                ii = dr("Area").ToString
            End If
            c4.Text = dr("Longitude")
            c5.Text = dr("Latitude")

            r1.Cells.Add(c3)
            r1.Cells.Add(c4)
            r1.Cells.Add(c5)
            t3.Rows.Add(r1)
        Next



        Panel1.Controls.Add(t3)

        DownloadReport(Panel1, "ProjectInformation")

    End Sub
    Private Sub GenerateOrder(ByVal p As Project)
        Dim prtOrderOfPayment As Document = New Document(PageSize.A4, 10.0F, 10.0F, 60.0F, 10.0F)

        'Dim path As String = Server.MapPath("DispositionForms")
        'PdfWriter.GetInstance(prtOrderOfPayment, New FileStream(path + "/" + Me.txtReferenceNo.Text + ".pdf", FileMode.Create))

        Dim bf As BaseFont = BaseFont.CreateFont(BaseFont.TIMES_ROMAN, BaseFont.CP1252, False)
        Dim fbs As Font = New Font(bf, 8, Font.BOLD, ExtendedColor.BLACK)
        Dim f As Font = New Font(bf, 10)
        Dim fb As Font = New Font(bf, 10, Font.BOLD, ExtendedColor.BLACK)
        Dim fi As Font = New Font(bf, 9, Font.ITALIC, ExtendedColor.BLACK)
        Dim fs As Font = New Font(bf, 7)
        Dim fsu As Font = New Font(bf, 7, Font.UNDERLINE)
        Dim fm As Font = New Font(bf, 11)
        Dim fmb As Font = New Font(bf, 11, Font.BOLD, ExtendedColor.BLACK)
        Dim fl As Font = New Font(bf, 12, Font.BOLD, ExtendedColor.BLACK)
        Dim fxl As Font = New Font(bf, 13, Font.BOLD, ExtendedColor.BLACK)

        prtOrderOfPayment.Open()

        Dim t As PdfPTable = New PdfPTable(3)
        t.SetWidths({35, 5, 50})
        't.WidthPercentage = 90

        Dim c As PdfPCell = New PdfPCell(New Phrase("Environmental Management Bureau", fmb))
        'c.PaddingBottom = 15.0F
        c.Border = 0
        c.HorizontalAlignment = 1
        c.Colspan = 3
        t.AddCell(c)


        Dim c1 As PdfPCell = New PdfPCell(New Phrase("Environmental Impact Assessment Division", fl))

        c1.PaddingBottom = 15.0F
        c1.HorizontalAlignment = 1
        c1.VerticalAlignment = 0
        c1.Border = 0
        c1.Colspan = 3
        t.AddCell(c1)

        Dim c2 As PdfPCell = New PdfPCell(New Phrase("ORDER OF PAYMENT", fxl))
        c2.HorizontalAlignment = 1
        c2.PaddingBottom = 15.0F
        c2.Border = 0
        c2.Colspan = 3
        t.AddCell(c2)

        'Dim c2a As PdfPCell = New PdfPCell(New Phrase("(Valid until " + String.Format("{0:MM/dd/yyyy}", DateAdd(DateInterval.Day, 15, Now())).ToString + ")", fs))
        'c2a.PaddingBottom = 15.0F
        'c2a.HorizontalAlignment = 1
        'c2a.Border = 0
        'c2a.Colspan = 3
        't.AddCell(c2a)

        Dim c3a As PdfPCell = New PdfPCell(New Phrase("Application Reference No.", fb))
        c3a.Border = 0
        t.AddCell(c3a)

        Dim c3b As PdfPCell = New PdfPCell(New Phrase(":", fb))
        c3b.Border = 0
        ' c3b.Width = Unit.Pixel(5).Value
        t.AddCell(c3b)

        Dim c3c As PdfPCell = New PdfPCell(New Phrase(p.GUID.ToString, fb))
        c3c.Border = 0
        t.AddCell(c3c)



        Dim c4a As PdfPCell = New PdfPCell(New Phrase("Name of Project Proponent", fb))
        c4a.Border = 0
        t.AddCell(c4a)

        Dim c4b As PdfPCell = New PdfPCell(New Phrase(":", fb))
        c4b.Border = 0
        t.AddCell(c4b)

        Dim pp As New Proponent
        pp = pp.GetProponent(p.ProponentGUID.ToString)
        Dim c4c As PdfPCell = New PdfPCell(New Phrase(pp.ProponentName.ToString, fb))
        c4c.Border = 0
        t.AddCell(c4c)

        Dim c5a As PdfPCell = New PdfPCell(New Phrase("Project Name", fb))
        c5a.Border = 0
        t.AddCell(c5a)

        Dim c5b As PdfPCell = New PdfPCell(New Phrase(":", fb))
        c5b.Border = 0
        t.AddCell(c5b)

        Dim c5c As PdfPCell = New PdfPCell(New Phrase(p.ProjectName.ToString, fb))
        c5c.Border = 0
        t.AddCell(c5c)



        Dim c6a As PdfPCell = New PdfPCell(New Phrase("Project Location", fb))
        c6a.Border = 0
        t.AddCell(c6a)

        Dim c6b As PdfPCell = New PdfPCell(New Phrase(":", fb))
        c6b.Border = 0
        t.AddCell(c6b)

        Dim c6c As PdfPCell = New PdfPCell(New Phrase(p.Address.ToString + " " + p.Municipality.ToString + ", " + p.Province.ToString, fb))
        c6c.Border = 0
        t.AddCell(c6c)




        Dim c7a As PdfPCell = New PdfPCell(New Phrase("Order of Payment Reference No", fb))
        c7a.Border = 0
        t.AddCell(c7a)

        Dim c7b As PdfPCell = New PdfPCell(New Phrase(":", fb))
        c7b.Border = 0
        t.AddCell(c7b)

        Dim c7c As PdfPCell = New PdfPCell(New Phrase(p.OrderOfPayment.ToString, fb))
        c7c.Border = 0
        t.AddCell(c7c)

        Dim c7a1 As PdfPCell = New PdfPCell(New Phrase("Order of Payment Date", fb))
        c7a1.Border = 0
        t.AddCell(c7a1)

        Dim c7b1 As PdfPCell = New PdfPCell(New Phrase(":", fb))
        c7b1.Border = 0
        t.AddCell(c7b1)

        Dim c7c1 As PdfPCell = New PdfPCell(New Phrase(String.Format("{0:MM/dd/yyyy}", Today.Date).ToString, fb))
        c7c1.Border = 0
        t.AddCell(c7c1)


        Dim c88a As PdfPCell = New PdfPCell(New Phrase("Agency Code", fb))
        c88a.Border = 0
        t.AddCell(c88a)

        Dim c88b As PdfPCell = New PdfPCell(New Phrase(":", fb))
        c88b.Border = 0
        t.AddCell(c88b)

        Dim c88c As PdfPCell = New PdfPCell(New Phrase(Application("AgencyCode").ToString, fb))
        c88c.Border = 0
        t.AddCell(c88c)

        Dim c8a As PdfPCell = New PdfPCell(New Phrase("Merchant/Agency Deposit Account No.", fb))
        c8a.Border = 0
        t.AddCell(c8a)

        Dim c8b As PdfPCell = New PdfPCell(New Phrase(":", fb))
        c8b.Border = 0
        t.AddCell(c8b)

        Dim c8c As PdfPCell = New PdfPCell(New Phrase(Application("AgencyAccountNo").ToString, fb))
        c8c.Border = 0
        t.AddCell(c8c)

        Dim c9a As PdfPCell = New PdfPCell(New Phrase("Total Application Fee", fb))
        c9a.Border = 0
        t.AddCell(c9a)

        Dim c9b As PdfPCell = New PdfPCell(New Phrase(":", fb))
        c9b.Border = 0
        t.AddCell(c9b)

        Dim c9c As PdfPCell = New PdfPCell(New Phrase(Application("Fees").ToString, fb))
        c9c.PaddingBottom = 10.0F
        c9c.Border = 0
        t.AddCell(c9c)


        Dim c10 As PdfPCell = New PdfPCell(New Phrase("", fl))
        'c10.PaddingBottom = 20.0F
        c10.HorizontalAlignment = 1
        c10.Border = Rectangle.BOTTOM_BORDER
        c10.Colspan = 3
        t.AddCell(c10)

        Dim c11 As PdfPCell = New PdfPCell(New Phrase("For internet-based payment, please visit https://www.lbp-eservices.com/egps/portal/index.jsp. For Over-the-counter payment, see instruction below.", fb))
        c11.Border = 0
        c1.PaddingTop = 15.0F
        c11.PaddingBottom = 5.0F
        c11.Colspan = 3
        t.AddCell(c11)

        Dim c12 As PdfPCell = New PdfPCell(New Phrase("1. Proceed to any landbank branches to fill-up the ONCOLL Payment Slip indicating the account reflected in the order of payment and the EMB as the Agency Name. Other fields should be accomplished as follows:", fm))
        c12.HorizontalAlignment = Element.ALIGN_JUSTIFIED
        c12.Border = 0
        c12.Colspan = 3
        t.AddCell(c12)

        Dim c13 As PdfPCell = New PdfPCell(New Phrase("         Reference No. 1: Project Name.", fm))
        c13.Border = 0
        c13.Colspan = 3
        t.AddCell(c13)

        Dim c14 As PdfPCell = New PdfPCell(New Phrase("         Reference No. 2: Agency Code.", fm))
        c14.Border = 0
        c14.Colspan = 3
        t.AddCell(c14)


        Dim c15 As PdfPCell = New PdfPCell(New Phrase("         Reference No. 3: Order of Payment Reference No.", fm))
        c15.Border = 0
        c15.PaddingBottom = 5.0F
        c15.Colspan = 3
        t.AddCell(c15)

        Dim c16 As PdfPCell = New PdfPCell(New Phrase("2. Present Accomplished ONCOLL Payment Slip together with this Order of Payment and payment to the Bank Teller.", fm))
        c16.HorizontalAlignment = Element.ALIGN_JUSTIFIED
        c16.Border = 0
        c16.PaddingBottom = 5.0F

        c16.Colspan = 3
        t.AddCell(c16)


        Dim c17 As PdfPCell = New PdfPCell(New Phrase("3. Secure Teller’s Validation.", fm))
        c17.Border = 0
        c17.PaddingBottom = 5.0F

        c17.Colspan = 3
        t.AddCell(c17)



        'Dim c18 As PdfPCell = New PdfPCell(New Phrase("4. Input payment transaction reference information in the Online CNC System on or before (15 days from inputting the project information). Otherwise, the application will automatically be removed from the system and the project information has to be re-encoded to generate a new order of payment.", fm))
        'c18.HorizontalAlignment = Element.ALIGN_JUSTIFIED
        'c18.Border = 0
        'c18.Colspan = 3
        'c18.PaddingBottom = 5.0F
        't.AddCell(c18)

        Dim c18a As PdfPCell = New PdfPCell(New Phrase("Note: Payment non-refundable.", fm))
        c18a.HorizontalAlignment = Element.ALIGN_JUSTIFIED
        c18a.Border = 0
        c18a.Colspan = 3
        c18a.PaddingBottom = 50.0F
        t.AddCell(c18a)

        Dim c19 As PdfPCell = New PdfPCell(New Phrase("************** This is a computer generated document. Signature not required **************.", fs))
        c19.Border = 0
        c19.Colspan = 3
        c19.HorizontalAlignment = 1
        t.AddCell(c19)


        Dim c20 As PdfPCell = New PdfPCell(New Phrase("Date Generated: " + Now().ToString, fs))
        c20.Border = 0
        c20.Colspan = 3
        c20.HorizontalAlignment = 1
        t.AddCell(c20)

        t.CompleteRow()

        PdfWriter.GetInstance(prtOrderOfPayment, Response.OutputStream)

        prtOrderOfPayment.Open()
        prtOrderOfPayment.Add(t)
        prtOrderOfPayment.Close()


        Response.ContentType = "application/pdf"
        Response.AddHeader("content-disposition", "attachment; filename=" + Request.QueryString("GUID").ToString + ".pdf")
        Response.End()
    End Sub
    Private Sub DownloadReport(ByVal panel1 As Panel, ByVal t As String)

        Response.ContentType = "application/pdf"
        Response.AddHeader("content-disposition", "attachment;filename=" + t.ToString + ".pdf")
        Response.Cache.SetCacheability(HttpCacheability.NoCache)
        Dim sw As New StringWriter
        Dim hw As HtmlTextWriter = New HtmlTextWriter(sw)
        panel1.RenderControl(hw)

        Dim sr As StringReader = New StringReader(sw.ToString)
        Dim pdfDoc As Document = New Document(PageSize.LEGAL, 50.0F, 50.0F, 50.0F, 50.0F)
        Dim htmlparser As HTMLWorker = New HTMLWorker(pdfDoc)

        If Title <> "SwornStatement" Then
            Dim styles As New StyleSheet
            styles.LoadTagStyle(HtmlTags.TD, HtmlTags.BORDER, "1")  'for html tag
            styles.LoadTagStyle(HtmlTags.SPAN, HtmlTags.CELLPADDING, "5px")  'for html tag

            htmlparser.SetStyleSheet(styles)

        End If

        PdfWriter.GetInstance(pdfDoc, Response.OutputStream)
        pdfDoc.Open()
        htmlparser.Parse(sr)
        pdfDoc.Close()
        Response.Write(sw.ToString())
        Response.Flush()
        Response.End()

    End Sub
    

End Class
