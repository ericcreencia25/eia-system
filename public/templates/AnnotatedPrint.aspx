<%@ Page Language="VB" AutoEventWireup="false" CodeFile="AnnotatedPrint.aspx.vb" Inherits="Secured_Templates_AnnotatedPrint" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html  xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word'  xmlns="http://www.w3.org/1999/xhtml">
  <head>
 <title></title>
    <style type="text/css"  >
      html, body {
    margin: 0;
    padding: 0;
}
html { height: 100% }

body { min-height: 100% }
    </style>
 </head>
  <body style="font-size:9.5pt; font-family:Arial;   "   >

    <form id="form1" runat="server">
        <asp:Panel ID="Panel1" style="font-size:9.5pt; font-family:Arial; border-bottom:none; "  CssClass="Section1"   runat="server">
            <div style="font-size:12pt; ;">
    National Solid Waste Management Commission-Secretariat Office<br />
920-2252/79 www.nswmc.org.ph/ www.emb.gov.ph/nswmc
    </div>
        <table class="thintable"  style="width:100%; color:Black; font-family:Tahoma; font-size:10pt;"  cellpadding="4" cellspacing="0"  >
    
        <tr style="font-weight:bold;">
            <td>
            OUTLINE
            
            </td>
            <td style="width:40%;">
            Short description
            </td>
            <td style="width:35%;">
            Evaluation and recommendation
            </td>
        </tr>

        <tr>
        
            <td>EXECUTIVE SUMMARY</td>
            <td>Overview of the plan including current situation, vision, and objectives</td>
            <td>
                <asp:Label ID="ExecSum" runat="server" ></asp:Label></td>
        </tr>

           <tr>
        
            <td>1.  Introduction</td>
            <td>Introduction to the plan to the reader including purpose and approach</td>
            <td>
                <asp:Label ID="Intro" runat="server" ></asp:Label></td>
        </tr>
   <tr>
        
            <td>1.1 Purpose</td>
            <td><ul><li/>City/municipality&rsquo;s vision related to solid waste management
<li/>Key issues facing the community 
<li/>Goals for the plan, and how the plan will help to alleviate the issues facing the community
<li/>Intent of RA 9003 and its effect on solid waste management</ul>
</td>
            <td>
                <asp:Label ID="Purpose" runat="server" ></asp:Label></td>
        </tr>
   <tr>
        
            <td>1.2 Approach</td>
            <td><ul><li/>	Approach used in preparing plan, e.g., compilation of existing information, conduct of WACS, using results of previous studies, involvement of stakeholders, etc.
<li/>	Data sources, e.g., National Solid Waste Management Commission, Solid Waste Management Board, City Planning and Development Office and City Engineering Office provide data for analyses and development of forecasts.
</ul></td>
            <td>
                <asp:Label ID="Approach" runat="server" ></asp:Label></td>
        </tr>
   <tr>
        
            <td colspan="2">1.3 Acknowledgements</td>
            <td>
                <asp:Label ID="Acknowl" runat="server" ></asp:Label></td>
        </tr>
   <tr>
        
            <td style="font-weight:bold;">2.  City/Municipal Profile</td>
            <td>Key information about the city/municipality</td>
            <td>
                <asp:Label ID="CityMunProfile" runat="server" Text=""></asp:Label></td>
        </tr>
   <tr>
        
            <td>2.1 Location</td>
            <td><ul><li/>	Location of the city/municipality including map indicating locations of barangays, as well as residential, commercial, and industrial centers, and agricultural areas.
<li/>	Land area.</ul>
</td>
            <td>
                <asp:Label ID="Location" runat="server" ></asp:Label></td>
        </tr>
   <tr>
        
            <td>2.1 History</td>
            <td><ul><li/>	Historical background.</ul></td>
            <td>
                <asp:Label ID="History" runat="server" ></asp:Label></td>
        </tr>
   <tr>
        
            <td>2.2 Population</td>
            <td><ul><li/>	Current population for each barangay, indicating rural and urban areas.
<li/>	10-yr projection.</ul>
</td>
            <td>
                <asp:Label ID="Popula" runat="server" ></asp:Label></td>
        </tr>
   <tr>
        
            <td>2.3 Economic Profile/Land Use</td>
            <td><ul><li/>	List of industries within the city/municipality.
<li/>	Land use map, in particular showing the urban and rural land use classification.
<li/>	Major transportation routes and traffic conditions.</ul>
</td>
            <td>
                <asp:Label ID="EcoProf" runat="server" ></asp:Label></td>
        </tr>
   <tr>
        
            <td>2.4 Physical Characteristics</td>
            <td><ul><li/>	Geography, geology, hydrology, soil and climate of the area or region.</ul></td>
            <td>
                <asp:Label ID="PhysChar" runat="server" ></asp:Label></td>
        </tr>
   <tr>
        
            <td style="font-weight:bold;">3. Current Solid Waste Management Conditions</td>
            <td>Description of solid waste management practices in existence</td>
            <td>
                <asp:Label ID="CurSWMCond" runat="server" Text=""></asp:Label></td>
        </tr>
   <tr>
        
            <td>3.1 Institutional Arrangements</td>
            <td><ul><li/>	List of existing agencies of the city administration that handle SWM and its services, and the roles and responsibilities of the agencies.  Should include all aspects of SWM such as:  collection, recycling, disposal, IEC, accounting, implementation and enforcement of regulations. </ul> </td>
            <td>
                <asp:Label ID="InstiArr" runat="server" ></asp:Label></td>
        </tr>
   <tr>
        
            <td>3.2 Inventory of Equipment and Staff</td>
            <td><ul><li/>	List of existing equipment, its capacity and present conditions, make, model, location for repairs, and others.  
<li/>	Number of personnel and classification working in SWM by department or type of service.
<li/>	Type of staff training available.</ul>
</td>
            <td>
                <asp:Label ID="InventEquip" runat="server" ></asp:Label></td>
        </tr>

          <tr>
        
            <td>3.3 Source Reduction</td>
            <td>Discussion of existing waste reduction practices.</td>
            <td>
                <asp:Label ID="SourceRedu" runat="server" ></asp:Label></td>
        </tr>

  <tr>
             <td>3.4 Collection</td>
            <td>Description of existing system for each service area, including those serviced by private haulers.




Type of collection (segregated vs. non-segregated).
Frequency of collection to same area for each type of collection.
Description of areas not currently receiving collection service.
If collection service is by a private hauler, provide a list of the haulers, service areas, types of waste collected, location where waste is deposited.  
</td>
            <td>
                <asp:Label ID="Collection" runat="server" ></asp:Label></td>
        </tr>

  <tr>
        
            <td>3.5 Transfer </td>
            <td>Description of facilities used to transfer solid waste.
List of facilities including location, capacity, types of materials accepted, and source of materials.
</td>
            <td>
                <asp:Label ID="Trasfer" runat="server" ></asp:Label></td>
        </tr>

  <tr>
        
            <td>3.6 Processing Facilities</td>
            <td>Description of facilities used for processing waste, such as material recovery facilities (MRFs) and composting facilities.
List of facilities including location, capacity, types of materials accepted, source of materials, and brief description of operations.
</td>
            <td>
                <asp:Label ID="ProcFacili" runat="server" ></asp:Label></td>
        </tr>

  <tr>
        
            <td>3.7 Final Disposal</td>
            <td>Description of facilities used for the final disposal of solid waste or residues from processing.
List of facilities including location, ownership, capacity, types of materials accepted, source of materials, brief description of operations, and number of scavengers.
Evaluation of the situation of scavengers working at existing dumpsite.
</td>
            <td>
                <asp:Label ID="FinalDispo" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>3.8 Special Wastes</td>
            <td>Existing storage, collection, and disposal practices for special wastes (includes junk cars, infectious/medical waste, waste oil recycling, scrap tires, construction and demolition debris and sewage sludge, as well as hazardous waste generated by individual households and businesses that may enter the disposal site).
Report of available information on the quantities of these wastes disposed. 
</td>
            <td>
                <asp:Label ID="SpecialWaste" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>3.9 Markets for Recyclables</td>
            <td>List of junk shops in the city/municipality.  Include types and quantities of materials accepted if possible.
List of industries in the city/municipality that use or could use recycled materials.
</td>
            <td>
                <asp:Label ID="MarketsRecyc" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>3.10 IEC</td>
            <td>Description of IEC program.
List of IEC activities.  Include message, targeted audience, and effectiveness.
</td>
            <td>
                <asp:Label ID="EIC" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>3.11 Costs and Revenues</td>
            <td><ul><li/>	Annual budget for SWM.
<li/>	Expenditures for previous year.  Include capital investment, operation and maintenance, and contracted services.
<li/>	Revenues for previous year.  Include revenues from allocations, from fees charged for the service, and from fines.  </ul>
</td>
            <td>
                <asp:Label ID="CostRev" runat="server" ></asp:Label></td>
        </tr>
          <tr>
        
            <td>3.11 Key Issues </td>
            <td>Brief description of key solid waste management issues facing the community. </td>
            <td>
                <asp:Label ID="KeyIssues" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td style="font-weight:bold;">4. Waste Characteristics</td>
            <td>Uses results of WACS and recycling information to determine quantity and composition of waste generated</td>
            <td>
                <asp:Label ID="WasteCharac" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>4.1 Disposed Waste (from WACS)</td>
            <td>Quantity of waste disposed, by sector (e.g., low-income residential, middle-income residential, high-income residential, commercial, institutional, industrial, markets) (in kg/day and tonnes/year)). 
Composition of waste disposed, by sector (in wt. %).  
Results of bulk density analysis (in kg/m3).
Results of moisture content analysis (in %).
Summary tables and figures showing the quantity and composition of disposed waste by, by sector.  
</td>
            <td>
                <asp:Label ID="DisposedWaste" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>4.2 Diverted Waste</td>
            <td>Estimate of quantity of waste currently recycled and composted based on existing information, and from results of 3.4 and 3.6.</td>
            <td>
                <asp:Label ID="DivertedWaste" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>4.3 Generated Waste </td>
            <td>Estimate of quantity of waste generated (disposed + diverted).
Projection of quantity of waste generated based on population projections.
</td>
            <td>
                <asp:Label ID="GeneratedWaste" runat="server" ></asp:Label></td>
        </tr>

          <tr>
        
            <td style="font-weight:bold;">5. Legal/Institutional Framework</td>
            <td>Overview of existing institutional arrangements in order to identify parties responsible for undertaking the relevant aspects of the plan</td>
            <td>
                <asp:Label ID="LegalInstFrame" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>5.1 Local Laws and Regulations</td>
            <td>Related laws and regulations and their relevant provisions.
Permitting procedures for solid waste facilities as well as inspection and compliance procedures.
</td>
            <td>
                <asp:Label ID="LocalLaws" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>5.2 Roles</td>
            <td>Roles of the City SWM Board, the city, barangay, private entities and institutions as generators, citizens, NGOs and recycling companies.</td>
            <td>
                <asp:Label ID="Roles" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>5.3 City/Municipal Solid Waste Management Board </td>
            <td>Sanguniang Panglungsod Ordinance No. for creating the CSWM Board.
List of members of the CSWM Board.
Description of activities to date and planned activities.
</td>
            <td>
                <asp:Label ID="SWMBoard" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>5.4 Barangay Solid Waste Management Committees</td>
            <td>List of BSWM Committees formed to date and schedule for Boards in other barangays</td>
            <td>
                <asp:Label ID="BrgySWMComm" runat="server" ></asp:Label></td>
        </tr>
          <tr>
        
            <td>5.5 Stakeholders Participation</td>
            <td>Activities conducted and future plans to involve stakeholders in development and implementation of plan.</td>
            <td>
                <asp:Label ID="StakeParti" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td style="font-weight:bold;">6. Plan Strategy</td>
            <td>Delineation of the desired outcome of the solid waste management plan</td>
            <td>
                <asp:Label ID="PlanStrat" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>6.1 Vision</td>
            <td>Discussion of vision and goals</td>
            <td>
                <asp:Label ID="Vision" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>6.2 Targets </td>
            <td><ul><li/>	Diversion targets for each year, 10-year planning period.
<li/>	Disposal targets for each year, 10-year planning period.</ul>
</td>
            <td>
                <asp:Label ID="Target" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>6.3 Strategies</td>
            <td><ul><li/>	Brief description of strategies to reach diversion targets (detail will be provided in Section 7).
<li/>	General description of coordination with barangays to implement segregated collection, MRFs, and composting facilities.
<li/>	General description of collection and transfer.
<li/>	Overview of plans for disposal.
<li/>	Discussion of other key elements of strategy.</ul>
</td>
            <td>
                <asp:Label ID="Strategies" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td style="font-weight:bold;">7. SWM System</td>
            <td>Detailed description of each program that will be implemented to reach the objectives and targets defined in Section 6</td>
            <td>
                <asp:Label ID="SWMSystem" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>7.1 Source Reduction</td>
            <td><ul><li/>	Source reduction programs to be implemented and implementation schedule.
<li/>	Sectors to target.
<li/>	Materials to be addressed and methods to determine the categories of solid waste to be diverted.
<li/>	Capability and economic viability of the city/municipality in implementing the program for this component.
<li/>	Technical requirements for the ordinances and other formal actions to be taken by the city/municipality. 
<li/>	Social impacts on stakeholders involved or affected.
<li/>	Estimated diversion resulting from source reduction.</ul>
</td>
            <td>
                <asp:Label ID="SWMSourceRedu" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>7.2 Collection</td>
            <td>Collection of segregated recyclable and compostable materials is the responsibility of the barangay.  Collection of mixed solid waste and residuals is the responsibility of the city/municipality.  The SWM plan should describe how the city/municipality will coordinate collection activities with the barangay.</td>
            <td>
                <asp:Label ID="SWMCollection" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>7.2.1  Overview</td>
            <td>Description of the strategy for collection, based on the projected quantities of segregated biodegradables and recyclables, and of residual waste.
Description of collection process for each type of waste.
Types of collection vehicles, collection frequency, collection points, and types of containers.
Entity responsible for providing collection for each type of waste, and for each sector.  
</td>
            <td>
                <asp:Label ID="Overview" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>7.2.2  Collection equipment and routes</td>
            <td>Description of each generator type and service area, and the particular requirements for collection equipment.
Table listing current number of vehicles (compaction vehicles and/or dump trucks) and projection of additional vehicles to be purchased by year. 
Rationale for selection of the equipment.
Listing of collection routes or service areas.
</td>
            <td>
                <asp:Label ID="CollEquipRoutes" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>7.2.3  Private collection service</td>
            <td>If collection service will be conducted by private haulers, provide a rationale for contracting out the service.
Listing of service areas, types of waste to be collected, location where waste will be taken.  
Discussion of basic terms of contract.
</td>
            <td>
                <asp:Label ID="PrvtCollSev" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>7.2.4  Storage and setout</td>
            <td>Types of containers to be used for each generator type and service area, and rationale for selection of types of containers.
Setout requirements (i.e., placement, time of day, etc.).
</td>
            <td>
                <asp:Label ID="StoraSetout" runat="server" ></asp:Label></td>
        </tr>
  <tr>
        
            <td>7.2.5 Segregated recyclables</td>
            <td>Strategy for implementing segregated collection of recyclables in each of the barangays.
Types of materials to include types of vehicles, collection frequency, types of containers.
Assistance the city/municipality will provide to the barangay.
</td>
            <td>
                <asp:Label ID="SegreRecyc" runat="server" ></asp:Label></td>
        </tr>
  <tr>        
            <td>7.2.6 Segregated compostables</td>
            <td>Strategy for implementing segregated collection of recyclables in each of the barangays.
Types of materials to include types of vehicles, collection frequency, types of containers.
Assistance the city/municipality will provide to the barangay.
</td>
            <td>
                <asp:Label ID="SegreComp" runat="server" ></asp:Label></td>
        </tr>
        <tr>
            <td>7.2.7 Mixed solid waste/residuals
            </td>
            <td><ul><li/>	Plan for collecting mixed solid waste (until segregated collection is implemented in all barangays).
<li/>	Plan for collecting residuals.
Table listing type of collection vehicle, capacity, and collection frequency by year for 5 years.  In preparing table, consideration should be given to the quantities of waste requiring collection and disposal as diversion programs are implemented. 
Types of containers that may be used for setout.
Plan for increasing coverage area to provide collection service to all parts of the city/municipality (if applicable).

            </td>
            <td>
            <asp:Label ID="SegreResid" runat="server" ></asp:Label>
            </td>
        </tr>
        <tr>
            <td>7.3 Segregation, Recycling, and Composting
            </td>
            <td>Segregation and recycling and composting of segregated materials are the responsibility of the barangay.  The SWM plan should describe how the city/municipality will work with the barangay to implement the programs.
            </td>
            <td>
                        <asp:Label ID="SegreRecycComp" runat="server" ></asp:Label>

            </td>
        </tr>
            <tr>
            <td>7.3.1 Segregation 
            </td>
            <td>Strategy for promoting segregation in each of the barangays.
Strategies for start-up, implementation, monitoring, and enforcement.
Assistance the city/municipality will provide to the barangay.

            </td>
            <td>
                        <asp:Label ID="Segregation" runat="server" ></asp:Label>

            </td>
        </tr>    <tr>
            <td>7.3.2 Recycling
            </td>
            <td><ul><li/>	Strategy for implementing MRFs in each of the barangays or in clusters of barangays.
<li/>	Strategies for start-up, implementation, monitoring, and enforcement.
<li/>	Materials to be recycled, methods of determining categories of recyclable waste for diversion 
<li/>	Existing capacity, future demand, and how the capacity will be met (e.g., new facilities and expansion of existing facilities)
<li/>	Assistance the city/municipality will provide to the barangay.
<li/>	Implementation schedule.</ul>

            </td>
            <td>
                        <asp:Label ID="Recycling" runat="server" ></asp:Label>

            </td>
        </tr>    <tr>
            <td>7.3.3 Composting/ Management of Biodegradable Waste
            </td>
            <td><ul><li/>	Overall strategy for managing biodegradable waste.
<li/>	Quantity of waste, by barangay, to be composted. 
<li/>	Existing capacity, future demand, and how the capacity will be met (e.g., new facilities and expansion of existing facilities).
<li/>	Strategy for implementing composting facilities in barangays or in clusters of barangays.
<li/>	Strategies for start-up, implementation, monitoring, and enforcement.
<li/>	Materials to be composted, methods of determining categories of biodegradable waste for diversion 
<li/>	Acceptable technologies and layouts of composting facilities.
<li/>	Assistance city/municipality will provide to the barangay.
<li/>	Implementation schedule.</ul>

            </td>
            <td>
                        <asp:Label ID="Composting" runat="server" ></asp:Label>

            </td>
        </tr>    <tr>
            <td>7.3.4 Marketing
            </td>
            <td><ul><li/>	Existing and planned markets for each recyclable material and for compost.
<li/>	Estimated prices for recovered materials and average selling price/average price.
<li/>	Strategies for expanding markets.
<li/>	Evaluation of feasibility of procurement preferences for recycled materials by city/municipality. 
</ul>
            </td>
            <td>
                        <asp:Label ID="Marketing" runat="server" ></asp:Label>

            </td>
        </tr>    <tr>
            <td>7.4 Transfer (if applicable)
            </td>
            <td><ul><li/>	Strategy for use of transfer facilities.
<li/>	Existing capacity, future demand, and how the capacity will be met (e.g., new facilities and expansion of existing facilities).
<li/>	Locations for new facilities, types and quantities of waste that will be accepted, source of waste, and destination of waste.
<li/>	Description of transfer station design and operations.
<li/>	Strategies for start-up, implementation, monitoring, and enforcement.
<li/>	Implementation schedule.
</ul>
            </td>
            <td>
                        <asp:Label ID="TransferApp" runat="server" ></asp:Label>

            </td>
        </tr>    <tr>
            <td>7.5 Disposal 
            </td>
            <td>Disposal plan for 10-years including identification of prospective sites for future use.  Include plans for upgrading or closing existing facilities to meet requirements for controlled disposal sites and sanitary landfills.  
            </td>
            <td>
                        <asp:Label ID="Disposal" runat="server" ></asp:Label>

            </td>
        </tr>

         <tr>
            <td>7.5.1 SW Disposal Capacity
            </td>
            <td><ul><li/>	Projection of the amount of disposal capacity needed to accommodate mixed solid waste and residuals, by year for a 10-year period.
<li/>	Comparison of existing disposal capacity with capacity requirements.
<li/>	Description of overall plan for disposal, by year
</ul>
            </td>
            <td>
                        <asp:Label ID="DisposalCap" runat="server" ></asp:Label>

            </td>
        </tr>

         <tr>
            <td>7.5.2 Existing Facilities
            </td>
            <td><ul><li/>	For each facility, indicate status (open dump, controlled dump, sanitary landfill) and disposal capacity.
<li/>	For open dumps, provide plan to close or to convert to controlled dumps within 3 years of effectivity of RA 9003.  Improvements to include: a well-maintained access road; restriction of waste to small working areas; regular cover of waste using inert material; control of surface water, litter, and waste picking; maintaining records. etc.
<li/>	For controlled dumps, provide plan to close or to convert to sanitary landfills (SLF) within 5 years of effectivity of RA 9003. 
<li/>	Strategies to extend life span and capacity of the existing disposal site.
<li/>	Closure plans to include methods of remediation of existing sites.</ul>

            </td>
            <td>
                        <asp:Label ID="ExistingFaci" runat="server" ></asp:Label>

            </td>
        </tr>
         <tr>
            <td>7.5.3 New Facilities
            </td>
            <td><ul><li/>	General description of new facilities (controlled dumps or sanitary landfills) that will be built.  Include:  location, ownership, capacity, and lifespan.  
<li/>	Explanation of how the design will meet the requirements of RA 9003 and its IRR.
<li/>	Rationale for site selection and in the design for the facility.  Refer to criteria set out by the ESWMA and by the earlier DAO 98.
</ul>
            </td>
            <td>
                        <asp:Label ID="NewFaci" runat="server" ></asp:Label>

            </td>
        </tr>
         <tr>
            <td>7.5.4 Sanitary Landfill (SLF) Design
            </td>
            <td><ul><li/>	Demonstration that the capacity will be adequate for a minimum of 5 years.  Address the population to be served, projected quantities of waste disposed, density of compacted waste, and volume of soil cover in the SLF. 
<li/>	Cross-sectional model of SLF as adapted to a flat area, mountainous area or any proposed area.
<li/>	Method for collection and treatment of leachate, and its adequacy to handle the projected maximum quantity of leachate (calculated based on the average daily rainfall for the maximum months multiplied by the area). 
<li/>	Operational practices to reduce the risk of environmental impact.
</ul>
            </td>
            <td>
                        <asp:Label ID="SanLanFillDesign" runat="server" ></asp:Label>

            </td>
        </tr>
         <tr>
            <td>7.6 Special Wastes
            </td>
            <td><ul><li/>	Existing storage, collection, disposal practices and the proper handling, re-use and long-term disposal.
<li/>	Estimated quantities of special wastes to be generated in the future.
<li/>	Description of programs to be implemented by the city/municipality describing how to handle, re-use, recycle, and provisos for long-term disposal. 
</ul>
            </td>
            <td>
                        <asp:Label ID="SpecialWastes" runat="server" ></asp:Label>

            </td>
        </tr>

                <tr>
            <td>7.7 Information, Education and Communication (IEC)
            </td>
            <td>Purpose and content of information dissemination, education and communication program
            </td>
            <td>
                        <asp:Label ID="IEC" runat="server" ></asp:Label>

            </td>
              </tr>
        <tr>
            <td>7.7.1 Introduction
            </td>
            <td>Discussion of strategy including need for public education and involvement.
Problems/issues that will be addressed.
Purpose of IEC activities (i.e., information dissemination, education, motivation, advocacy).
Audiences that will be targeted.

            </td>
            <td>
                        <asp:Label ID="Introduction" runat="server" ></asp:Label>

            </td>
        </tr>
                <tr>
            <td>7.7.2 Core Messages
            </td>
            <td>Discussion of core message(s) for each target audience.  
Explanation of how message will be coordinated with other agencies.
Description of how IEC activities will support solid waste management program activities, e.g., source reduction, litter prevention, segregation, recycling, and composting.

            </td>
            <td>
                        <asp:Label ID="CoreMessa" runat="server" ></asp:Label>

            </td>
        </tr>
                <tr>
            <td>7.7.2 Approach
            </td>
            <td>Discussion of approach(es) for each target audience.  
Matrix of planned activities.  Include: purpose, target audience, subject of message, method, responsible party, and monitoring plan.
Implementation schedule.  IEC activities should be integrated with infrastructure and should be on-going.
Cost of activities (to be incorporated into financial plan (see Section 11).

            </td>
            <td>
                        <asp:Label ID="ApproachTarg" runat="server" ></asp:Label>

            </td>
        </tr>
                <tr>
            <td>7.8 Market Development
            </td>
            <td>Methods for developing markets for recycled materials and compost.
Evaluation of the feasibility of procurement preferences to encourage the purchase of products made from recycled materials.
Evaluation of the feasibility of procurement preferences to encourage the purchase of compost.

            </td>
            <td>
                        <asp:Label ID="MarketDev" runat="server" ></asp:Label>

            </td>
        </tr>
                <tr>
            <td style="font-weight:bold;">8. Implementation Strategy
            </td>
            <td>Discussion of the logistics of how the solid waste management system will be implemented.
            </td>
            <td>
             <asp:Label ID="ImpleStrat" runat="server" ></asp:Label>

            </td>
        </tr>
        <tr>
            <td>8.1 Framework
            </td>
            <td><ul><li/>	Overview of each program to be implemented, by generator segment, by year.  Include source reduction, recycling, composting, disposal, etc.</ul>
            </td>
            <td>
                <asp:Label ID="Framework" runat="server" ></asp:Label>
            </td>
        </tr>

                <tr>
            <td>8.2 Diversion Projections
            </td>
            <td><ul><li/>	Table of types and percentages of materials to be diverted to meet the mandated diversion requirement.</ul>
            </td>
            <td>
                <asp:Label ID="DiverProj" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>8.3 Monitoring Program
            </td>
            <td><ul><li/>	Description of monitoring program to provide accurate information and to show whether or not policies are succeeding and to monitor the performance of the SWM plan.</ul>
            </td>
            <td>
                <asp:Label ID="MonProg" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>8.4 Alternatives Analysis
            </td>
            <td><ul><li/>	Options the municipalities might consider in their efforts to divert waste materials from disposal.</ul>
            </td>
            <td>
                <asp:Label ID="AlterAnal" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>8.5 Incentive Programs
            </td>
            <td><ul><li/>	Description of program providing for incentives (rewards, grants, fiscal incentives and non-fiscal Incentives) that will be provided to concerned sectors in order to encourage wide participation in the implementation of the plan.
<li/>	Potential benefits, if any, of Eco-labeling.</ul>

            </td>
            <td>
                <asp:Label ID="IncentProg" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td style="font-weight:bold;">9. Institutional Aspects
            </td>
            <td>Existing and planned structure for implementation of plan
            </td>
            <td>
                <asp:Label ID="InstituAsp" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>9.1 Roles
            </td>
            <td><ul><li/>	Future roles of the city SWM Board, the city, barangay, private entities and institutions as generators, citizens, NGOs and recycling companies.
<li/>	Strategy for cooperation with the city/municipal SWM Board.
<li/>	Coordination with other entities (e.g., barangays, NGOs, business leaders).</ul>

            </td>
            <td>
                <asp:Label ID="InstituRoles" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>9.2 Legal
            </td>
            <td><ul><li/>	Recommended changes to city structure.
<li/>	Zoning and building code changes.
<li/>	Plans to impose penal provisions.
<li/>	Other legal requirements.</ul>

            </td>
            <td>
                <asp:Label ID="InstituLegal" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td style="font-weight:bold;">10. Social and Environmental Aspects
            </td>
            <td>Discussion of social and environmental issues related development of full-scale infrastructure
            </td>
            <td>
                <asp:Label ID="SocialEnvAspects" runat="server" ></asp:Label>
            </td>
        </tr>

        
        <tr>
            <td>10.1 Social Aspects
            </td>
            <td><ul><li/>	Significant social impacts (both positive and negative) from community-based SWM.
<li/>	Social acceptability of proposed solid waste system (including collection system and processing and disposal sites.
<li/>	Discussion of requirements of stakeholders.
<li/>	Discussion of conditions concerning scavengers at the disposal site and what the city/municipality can do to improve their conditions.
</ul>
            </td>
            <td>
                <asp:Label ID="SocialAspects" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>10.2 Environmental Aspects
            </td>
            <td><ul><li/>	Discussion of environmental aspects of the proposed solid waste system.
<li/>	Environmental review requirements.
</ul>
            </td>
            <td>
                <asp:Label ID="EnviAspects" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td style="font-weight:bold;">11. Cost Estimates /Financial Aspects
            </td>
            <td>Financial plan for implementation of solid waste management system
            </td>
            <td>
                <asp:Label ID="CostEstimates" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>11.1 Investment cost
            </td>
            <td><ul><li/>	Breakdown of estimated investment cost by year for 5 years, by private and public sectors.  Investment costs should address each component of the solid waste system, i.e., collection, transfer stations, MRFs, composting facilities, and disposal facilities.
<li/>	Facility costs to include engineering and infrastructure.
<li/>	Equipment costs to include stationary equipment (e.g., shredder) and rolling equipment (e.g., collection vehicles)
<li/>	Estimated cost to be amortized based on life expectancy of facility/equipment.
</ul>
            </td>
            <td>
                <asp:Label ID="InvestCost" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>11.2 Annual Costs
            </td>
            <td><ul><li/>	Breakdown of annual costs by year for 5 years, by private and public sector.
<li/>	Labor cost, including fringes, by labor category.
<li/>	Administrative costs including insurance, office expense, etc.
<li/>	Operating and maintenance costs including fuel, repair, supplies, etc.
<li/>	Amortized investment cost.
<li/>	Loan repayment schedule.</ul>

            </td>
            <td>
                <asp:Label ID="AnnualCosts" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>11.3 Funding Options
            </td>
            <td><ul><li/>	Discussion of options to finance the capital investments, e.g., loans from financial institutions, central government grants, and municipal funds.
<li/>	Discussion of options to finance recurring cost, e.g., local taxes, intergovernmental transfers, and user charges.
<li/>	Presentation of existing and projected sources of revenues.  Include consideration of revenues from collection of fees; outside sources of funds, collection and use of fines, and sources for the local SWM fund and their uses.
<li/>	Specific projects, activities, equipment and technological requirement for which outside sourcing of funds or materials may be necessary.
<li/>	Breakdown of revenues by year for 5 years, and by source.
</ul>
            </td>
            <td>
                <asp:Label ID="FundOptions" runat="server" ></asp:Label>
            </td>
        </tr>


                <tr>
            <td>11.5 Cost Evaluation and Comparison
            </td>
            <td><ul><li/>	Cost for waste management per service capita.
<li/>	Cost for waste management by unit weight for each type of service, e.g., collection, processing, and disposal.
<li/>	Comparison of costs for each component of the solid waste management system.
<li/>	Discussion of ways to optimize costs.
</ul>
            </td>
            <td>
                <asp:Label ID="CostEvalComp" runat="server" ></asp:Label>
            </td>
        </tr>

                <tr>
            <td>11.6 Summary
            </td>
            <td><ul><li/>	Tabular summary of investment costs, annual costs, and annual revenues by year.</ul>
            </td>
            <td>
                <asp:Label ID="Summary" runat="server" ></asp:Label>
            </td>
        </tr>

         
        <tr>
            <td style="font-weight:bold;">12. Plan Implementation
            </td>
            <td>Implementation phases, milestones, and schedule 
            </td>
            <td>
                <asp:Label ID="PlanImp" runat="server" ></asp:Label>
            </td>
        </tr>

                <tr>
            <td>12.1 Phases and Responsibilities
            </td>
            <td><ul><li/>	Discussion of phases from the development of a plan to guide the operation and the implementing agency or persons/groups responsible.</ul>
            </td>
            <td>
                <asp:Label ID="PhaseRespo" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>12.2 Milestones
            </td>
            <td><ul><li/>	Milestones in implementation of the institutional/legal aspects of the plan including: public hearings, final approval of plan, and establishment of the SW Division.
<li/>	Milestones in implementation of the solid waste system described in the plan including:  source reduction activities, segregated collection in each barangay, establishment of MRFs and composting facilities, upgrade of dumpsites, establishment of sanitary landfills, IEC activities, etc. 
</ul>
            </td>
            <td>
                <asp:Label ID="Milestones" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>12.3 Implementation Schedule
            </td>
            <td><ul><li/>	Tables or diagrams showing the schedule of implementation.
<li/>	Schedule should include all of the programs discussed in Section 7.
<li/>	Table summarizing diversion goals and quantities.
</ul>
            </td>
            <td>
                <asp:Label ID="ImpSched" runat="server" ></asp:Label>
            </td>
        </tr>

        <tr>
            <td>References
            </td>
            <td>
            </td>
            <td>    
                <asp:Label ID="Refrnces" runat="server" ></asp:Label>
            </td>
        </tr>



    </table>
    </asp:Panel>
    </form>
</body>
</html>
