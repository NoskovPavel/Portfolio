function dump(obj, obj_name) {     //������� �������� ������� js
					  var result = ""
					  for (var i in obj)
						result += obj_name + "." + i + " = " + obj[i] + "\n";
					  return result
					}	