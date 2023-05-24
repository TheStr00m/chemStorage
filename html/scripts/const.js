const classAssoc = {
		//Physical Hazards
		
		"H200" : ["Explosives","Unstable explosive"],
		"H201" : ["Explosives", "Division 1.1"],
		"H202" : ["Explosives", "Division 1.2"],
		"H203" : ["Explosives", "Division 1.3"],
		"H204" : ["Explosives", "Division 1.4"],
		"H205" : ["Explosives", "Division 1.5"],

		"H206" : ["Desensitized explosives", "Category 1"],
		"H207" : ["Desensitized explosives", {"Warning":"Category 3","Danger":"Category 2"}],
		"H208" : ["Desensitized explosives", "Category 4"],

		"H220" : ["Flammable gases","Category 1"],
		"H221" : ["Flammable gases","Category 2"],
		"H230" : ["Flammable gases","Category A"],
		"H231" : ["Flammable gases","Category B"],
		"H232" : ["Flammable gases","Category 1"],

		"H222" : ["Aerosol","Category 1"],
		"H223" : ["Aerosol","Category 2"],
		"H229" : ["Aerosol","Category 1"],

		"H270" : ["Oxidising gases","Category 1"],

		"H280" : ["Gases under pressure", {"Compressed gas":"Compressed gas","Liquefied gas":"Liquefied gas","Dissolved gas":"Dissolved gas"}],
		"H281" : ["Gases under pressure","Refrigerated liquefied gas"],

		"H224" : ["Flammable liquids","Category 1"],
		"H225" : ["Flammable liquids","Category 2"],
		"H226" : ["Flammable liquids","Category 3"],
		"H227" : ["Flammable liquids","Category 4"],

		"H228" : ["Flammable solids", {"Warning":"Category 2","Danger":"Category 1"}],

		"H240" : ["Self-reactive substances and mixtures/Organic Peroxides","Type A"],
		"H241" : ["Self-reactive substances and mixtures/Organic Peroxides","Type B"],
		"H242" : ["Self-reactive substances and mixtures/Organic Peroxides", {"Warning":"Type E&F","Danger":"Type C&D"}],

		"H250" : ["Pyrophoric liquid/solid","Category 1"],

		"H251" : ["Self-heating substances and mixtures","Category 1"],
		"H252" : ["Self-heating substances and mixtures","Category 2"],

		"H260" : ["Substances or mixtures which in contact with water emit flammable gases","Category 1"],
		"H261" : ["Substances or mixtures which in contact with water emit flammable gases", {"Warning":"Category 3","Danger":"Category 2"}],

		"H271" : ["Oxidising liquid/solid","Category 1"],
		"H272" : ["Oxidising liquid/solid", {"Warning":"Category 3","Danger":"Category 2"}],

		"H290" : ["Corrosive to metals","Category 1"],

		//Health Hazards
		"H300" : ["Acute toxicity, oral","Category 1&2"],
		"H301" : ["Acute toxicity, oral","Category 3"],
		"H302" : ["Acute toxicity, oral","Category 4"],
		"H303" : ["Acute toxicity, oral","Category 5"],

		"H310" : ["Acute toxicity, dermal","Category 1&2"],
		"H311" : ["Acute toxicity, dermal","Category 3"],
		"H312" : ["Acute toxicity, dermal","Category 4"],
		"H313" : ["Acute toxicity, dermal","Category 5"],

		"H330" : ["Acute toxicity, inhalation","Category 1&2"],
		"H331" : ["Acute toxicity inhalation","Category 3"],
		"H332" : ["Acute toxicity inhalation","Category 4"],
		"H333" : ["Acute toxicity inhalation","Category 5"],

		"H314" : ["Skin corrosion/irritation","Category 1"],
		"H315" : ["Skin corrosion/irritation","Category 2"],
		"H316" : ["Skin corrosion/irritation","Category 3"],

		"H318" : ["Serious eye damage/eye irritation","Category 1"],
		"H319" : ["Serious eye damage/eye irritation","Category 2A"],
		"H320" : ["Serious eye damage/eye irritation","Category 2B"],

		"H334" : ["Sensitisation of the respiratory tract","Category 1"],
		"H317" : ["Sensitisation of the skin","Category 1"],

		
		"H340" : ["Germ cell mutagenicity","Category 1"],
		"H341" : ["Germ cell mutagenicity","Category 2"],

		
		"H350" : ["Carcinogenicity","Category 1"],
		"H351" : ["Carcinogenicity","Category 2"],

		"H360" : ["Reproductive toxicity","Category 1"],
		"H360D" : ["Reproductive toxicity","Category 1"],
		"H360F" : ["Reproductive toxicity","Category 1"],
		"H361" : ["Reproductive toxicity","Category 2"],
		"H361d" : ["Reproductive toxicity","Category 2"],
		"H361f" : ["Reproductive toxicity","Category 2"],
		"H362" : ["Reproductive toxicity","Additional category"],


		"H370" : ["Specific target organ toxicity, single exposure","Category 1"],
		"H371" : ["Specific target organ toxicity, single exposure","Category 2"],
		"H335" : ["Specific target organ toxicity, single exposure","Category 3"],
		"H336" : ["Specific target organ toxicity, single exposure","Category 3"],


		"H372" : ["Specific target organ toxicity, repeated exposure","Category 1"],
		"H373" : ["Specific target organ toxicity, repeated exposure","Category 2"],

		"H304" : ["Aspiration toxicity","Category 1"],
		"H305" : ["Aspiration toxicity","Category 2"],

		//Environmental Hazards
		"H400" : ["Hazardous to the aquatic environment, acute hazard","Category 1"],
		"H401" : ["Hazardous to the aquatic environment, acute hazard","Category 2"],
		"H402" : ["Hazardous to the aquatic environment, acute hazard","Category 3"],

		"H410" : ["Hazardous to the aquatic environment, long-term hazard","Category 1"],
		"H411" : ["Hazardous to the aquatic environment, long-term hazard","Category 2"],
		"H412" : ["Hazardous to the aquatic environment, long-term hazard","Category 3"],
		"H413" : ["Hazardous to the aquatic environment, long-term hazard","Category 4"],

		"H420" : ["Hazardous to the ozone layer","Category 1"],


		"H433" : ["Harmful to terrestrial vertebrates",""]
		
};

const ghsAssoc = {
	//Physical Hazards
	"H200" : "Unstable explosive",
	"H201" : "Explosive; mass explosion hazard",
	"H202" : "Explosive; severe projection hazard",
	"H203" : "Explosive; fire, blast or projection hazard",
	"H204" : "Fire or projection hazard",
	"H205" : "May mass explode in fire",
	"H206" : "Fire, blast or projection hazard: increased risk of explosion if desensitizing agent is reduced",
	"H207" : "Fire or projection hazard: increased risk of explosion if desensitizing agent is reduced",
	"H208" : "Fire hazard: increased risk of explosion if desensitizing agent is reduced",
	"H220" : "Extremely flammable gas",
	"H221" : "Flammable gas",
	"H222" : "Extremely flammable aerosol",
	"H223" : "Flammable aerosol",
	"H224" : "Extremely flammable liquid and vapour",
	"H225" : "Highly flammable liquid and vapour",
	"H226" : "Flammable liquid and vapour",
	"H227" : "Combustible liquid",
	"H228" : "Flammable solid",
	"H229" : "Pressurized container: may burst if heated",
	"H230" : "May react explosively even in the absence of air",
	"H231" : "May react explosively even in the absence of air at elevated pressure and/or temperature",
	"H232" : "May ignite spontaneously if exposed to air",
	"H240" : "Heating may cause an explosion",
	"H241" : "Heating may cause a fire or explosion",
	"H242" : "Heating may cause a fire",
	"H250" : "Catches fire spontaneously if exposed to air",
	"H251" : "Self-heating; may catch fire",
	"H252" : "Self-heating in large quantities; may catch fire",
	"H260" : "In contact with water releases flammable gases which may ignite spontaneously",
	"H261" : "In contact with water releases flammable gas",
	"H270" : "May cause or intensify fire; oxidizer",
	"H271" : "May cause fire or explosion; strong oxidizer",
	"H272" : "May intensify fire; oxidizer",
	"H280" : "Contains gas under pressure; may explode if heated",
	"H281" : "Contains refrigerated gas; may cause cryogenic burns or injury",
	"H290" : "May be corrosive to metals",

	//Health Hazards
	"H300" : "Fatal if swallowed.",
	"H301" : "Toxic if swallowed",
	"H302" : "Harmful if swallowed",
	"H303" : "May be harmful if swallowed",
	"H304" : "May be fatal if swallowed and enters airways",
	"H305" : "May be harmful if swallowed and enters airways",
	"H310" : "Fatal in contact with skin",
	"H311" : "Toxic in contact with skin",
	"H312" : "Harmful in contact with skin",
	"H313" : "May be harmful in contact with skin",
	"H314" : "Causes severe skin burns and eye damage",
	"H315" : "Causes skin irritation",
	"H316" : "Causes mild skin irritation",
	"H317" : "May cause an allergic skin reaction",
	"H318" : "Causes serious eye damage",
	"H319" : "Causes serious eye irritation",
	"H320" : "Causes eye irritation",
	"H330" : "Fatal if inhaled",
	"H331" : "Toxic if inhaled",
	"H332" : "Harmful if inhaled",
	"H333" : "May be harmful if inhaled",
	"H334" : "May cause allergy or asthma symptoms or breathing difficulties if inhaled",
	"H335" : "May cause respiratory irritation",
	"H336" : "May cause drowsiness or dizziness",
	"H340" : "May cause genetic defects",
	"H341" : "Suspected of causing genetic defects",
	"H350" : "May cause cancer",
	"H351" : "Suspected of causing cancer",
	"H360" : "May damage fertility or the unborn child",
	"H361" : "Suspected of damaging fertility or the unborn child",
	"H361d" : "Suspected of damaging the unborn child",
	"H360D" : "May damage the unborn child",
	"H361f" : "Suspected of damaging fertility",
	"H360F" : "May damage fertility",
	"H362" : "May cause harm to breast-fed children",
	"H370" : "Causes damage to organs",
	"H371" : "May cause damage to organs",
	"H372" : "Causes damage to organs through prolonged or repeated exposure",
	"H373" : "May cause damage to organs through prolonged or repeated exposure",

	//Environmental Hazards
	"H400" : "Very toxic to aquatic life",
	"H401" : "Toxic to aquatic life",
	"H402" : "Harmful to aquatic life",
	"H410" : "Very toxic to aquatic life with long-lasting effects",
	"H411" : "Toxic to aquatic life with long-lasting effects",
	"H412" : "Harmful to aquatic life with long-lasting effects",
	"H413" : "May cause long-lasting harmful effects to aquatic life",
	"H420" : "Harms public health and the environment by destroying ozone in the upper atmosphere",
	"H433" : "Harmful to terrestrial vertebrates"
	
};


//Exporting constants
export {ghsAssoc, classAssoc};
